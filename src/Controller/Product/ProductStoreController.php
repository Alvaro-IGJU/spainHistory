<?php

namespace App\Controller\Product;

use App\Test\Product\Application\StoreProduct\ProductStoreCommandHandler;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ProductStoreController extends AbstractController
{
    private ProductStoreCommandHandler $handler;

    public function __construct(ProductStoreCommandHandler $handler)
    {
        $this->handler = $handler;
    }

    public function __invoke(Request $request): Response
    {

        $imageFile = $request->files->get('file');
        $id = null;
        $iva = $request->get('iva');
        $description = $request->get('description');
        $name = $request->get('name');
        $price = $request->get('total');


        try {
            if ($imageFile) {
                $newFilename = uniqid().'_'.$imageFile->getClientOriginalName();
                try {
                    $imageFile->move(
                        $this->getParameter('image_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    return new Response('Error occurred during file upload', 500);
                }

            }

            if($request->get('image')){
                $imageFile=true;
                $newFilename=$request->get('image');
            }
            $data = ['IVA' => $iva, 'description' => $description, 'name' => $name,
                'price' => floatval($price), 'id' => $id, 'file' => $imageFile ? $newFilename : null];
            $response = $this->handler->handler($data);
            if ($response) {
                return new Response('Producto guardado');
            }
        } catch (\Exception $exception) {
            return new Response('Error save product', 500);
        }

        return new Response('Algo fallo');


    }


}
