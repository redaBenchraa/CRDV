<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateSerafinAPIRequest;
use App\Http\Requests\API\UpdateSerafinAPIRequest;
use App\Models\Serafin;
use App\Repositories\SerafinRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class SerafinController
 * @package App\Http\Controllers\API
 */

class SerafinAPIController extends AppBaseController
{
    /** @var  SerafinRepository */
    private $serafinRepository;

    public function __construct(SerafinRepository $serafinRepo)
    {
        $this->serafinRepository = $serafinRepo;
    }

    /**
     * Display a listing of the Serafin.
     * GET|HEAD /serafins
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->serafinRepository->pushCriteria(new RequestCriteria($request));
        $this->serafinRepository->pushCriteria(new LimitOffsetCriteria($request));
        $serafins = $this->serafinRepository->all();

        return $this->sendResponse($serafins->toArray(), 'Serafins retrieved successfully');
    }

    /**
     * Store a newly created Serafin in storage.
     * POST /serafins
     *
     * @param CreateSerafinAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateSerafinAPIRequest $request)
    {
        $input = $request->all();

        $serafins = $this->serafinRepository->create($input);

        return $this->sendResponse($serafins->toArray(), 'Serafin saved successfully');
    }

    /**
     * Display the specified Serafin.
     * GET|HEAD /serafins/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Serafin $serafin */
        $serafin = $this->serafinRepository->findWithoutFail($id);

        if (empty($serafin)) {
            return $this->sendError('Serafin not found');
        }

        return $this->sendResponse($serafin->toArray(), 'Serafin retrieved successfully');
    }

    /**
     * Update the specified Serafin in storage.
     * PUT/PATCH /serafins/{id}
     *
     * @param  int $id
     * @param UpdateSerafinAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateSerafinAPIRequest $request)
    {
        $input = $request->all();

        /** @var Serafin $serafin */
        $serafin = $this->serafinRepository->findWithoutFail($id);

        if (empty($serafin)) {
            return $this->sendError('Serafin not found');
        }

        $serafin = $this->serafinRepository->update($input, $id);

        return $this->sendResponse($serafin->toArray(), 'Serafin updated successfully');
    }

    /**
     * Remove the specified Serafin from storage.
     * DELETE /serafins/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Serafin $serafin */
        $serafin = $this->serafinRepository->findWithoutFail($id);

        if (empty($serafin)) {
            return $this->sendError('Serafin not found');
        }

        $serafin->delete();

        return $this->sendResponse($id, 'Serafin deleted successfully');
    }


    public function souscategories($id){
        $serafin = $this->serafinRepository->findWithoutFail($id);
        
        if (empty($serafin)) {
            return $this->sendError('Serafin not found');
        }

        return $this->sendResponse($serafin->souscategories,'souscategories retrieved successfully');
    }

    public function serafin($id){
        $serafin = $this->serafinRepository->findWithoutFail($id);
        
        if (empty($serafin)) {
            return $this->sendError('Serafin not found');
        }

        return $this->sendResponse($serafin->serafin,'serafin retrieved successfully');
    }


}
