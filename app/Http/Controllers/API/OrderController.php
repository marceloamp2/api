<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Order\IndexOrderRequest;
use App\Http\Requests\Order\StoreOrderRequest;
use App\Http\Requests\Order\UpdateOrderRequest;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use App\Models\Project;
use App\Services\Image\StoreImageService;
use App\Services\Order\DeleteOrderService;
use App\Services\Order\IndexOrderService;
use App\Services\Order\StoreOrderService;
use App\Services\Order\UpdateOrderService;
use App\Services\Project\AttachServicesToProjectService;
use App\Services\Project\StoreProjectService;
use App\Services\Project\UpdateProjectService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Storage;

class OrderController extends Controller
{
    public function index(
        IndexOrderRequest $indexOrderRequest,
        IndexOrderService $indexOrderService
    ): AnonymousResourceCollection
    {
        $data = $indexOrderRequest->validated();
        $orders = $indexOrderService->run($data);
        return OrderResource::collection($orders);
    }

    public function store(
        StoreOrderRequest              $storeOrderRequest,
        StoreOrderService              $storeOrderService,
        StoreProjectService            $storeProjectService,
        AttachServicesToProjectService $attachServicesToProjectService,
        StoreImageService              $storeImageService
    ): JsonResponse
    {
        $data = $storeOrderRequest->validated();

        $order = $storeOrderService->run($data);

        foreach ($data['projects'] as $dataProject) {
            $dataProject['order_id'] = $order->id;
            $project = $storeProjectService->run($dataProject);
            $attachServicesToProjectService->run($dataProject['services'], $project);

            foreach ($dataProject['images'] as $image) {
                $storeImageService->run($image, $project->id);
            }
        }

        $order->load('projects.services', 'projects.images');

        return response()->json([
            'status' => 'success',
            'message' => 'Pedido criado com sucesso',
            'data' => $order
        ]);
    }

    public function update(
        UpdateOrderRequest             $updateOrderRequest,
        UpdateOrderService             $updateOrderService,
        UpdateProjectService           $updateProjectService,
        AttachServicesToProjectService $attachServicesToProjectService,
        StoreImageService              $storeImageService,
        Order                          $order
    ): JsonResponse
    {
        $data = $updateOrderRequest->validated();
        $order = $updateOrderService->run($data, $order);

        foreach ($data['projects'] as $dataProject) {
            $project = Project::find($dataProject['id']);

            $updateProjectService->run($dataProject, $project);

            $attachServicesToProjectService->run($dataProject['services'], $project);

            foreach ($project->images as $image) {
                Storage::delete($image->url);
                $image->delete();
            }

            foreach ($dataProject['images'] as $image) {
                $storeImageService->run($image, $project->id);
            }
        }

        $order->load('projects.services', 'projects.images');

        return response()->json([
            'status' => 'success',
            'message' => 'Pedido atualizado com sucesso',
            'data' => $order
        ]);
    }

    public function destroy(
        DeleteOrderService $deleteOrderService,
        Order              $order
    ): JsonResponse
    {
        foreach ($order->projects as $project) {
            $project->services()->detach();

            foreach ($project->images as $image) {
                Storage::delete($image->url);
                $image->delete();
            }
        }

        $order->projects()->delete();

        $deleteOrderService->run($order);

        return response()->json([
            'status' => 'success',
            'message' => 'Pedido apagado com sucesso!'
        ]);
    }
}
