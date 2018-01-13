<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateAdaptationAPIRequest;
use App\Http\Requests\API\UpdateAdaptationAPIRequest;
use App\Models\Adaptation;
use App\Repositories\AdaptationRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class AdaptationController
 * @package App\Http\Controllers\API
 */

class AdaptationAPIController extends AppBaseController
{
    /** @var  AdaptationRepository */
    private $adaptationRepository;

    public function __construct(AdaptationRepository $adaptationRepo)
    {
        $this->adaptationRepository = $adaptationRepo;
    }

    /**
     * Display a listing of the Adaptation.
     * GET|HEAD /adaptations
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->adaptationRepository->pushCriteria(new RequestCriteria($request));
        $this->adaptationRepository->pushCriteria(new LimitOffsetCriteria($request));
        $adaptations = $this->adaptationRepository->paginate(10);

        return $this->sendResponse($adaptations->toArray(), 'Adaptations retrieved successfully');
    }

    /**
     * Store a newly created Adaptation in storage.
     * POST /adaptations
     *
     * @param CreateAdaptationAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateAdaptationAPIRequest $request)
    {
        $input = $request->all();

        $adaptations = $this->adaptationRepository->create($input);

        return $this->sendResponse($adaptations->toArray(), 'Adaptation saved successfully');
    }

    /**
     * Display the specified Adaptation.
     * GET|HEAD /adaptations/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Adaptation $adaptation */
        $adaptation = $this->adaptationRepository->findWithoutFail($id);

        if (empty($adaptation)) {
            return $this->sendError('Adaptation not found');
        }

        return $this->sendResponse($adaptation->toArray(), 'Adaptation retrieved successfully');
    }

    /**
     * Update the specified Adaptation in storage.
     * PUT/PATCH /adaptations/{id}
     *
     * @param  int $id
     * @param UpdateAdaptationAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateAdaptationAPIRequest $request)
    {
        $input = $request->all();

        /** @var Adaptation $adaptation */
        $adaptation = $this->adaptationRepository->findWithoutFail($id);

        if (empty($adaptation)) {
            return $this->sendError('Adaptation not found');
        }

        $adaptation = $this->adaptationRepository->update($input, $id);

        return $this->sendResponse($adaptation->toArray(), 'Adaptation updated successfully');
    }

    /**
     * Remove the specified Adaptation from storage.
     * DELETE /adaptations/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Adaptation $adaptation */
        $adaptation = $this->adaptationRepository->findWithoutFail($id);

        if (empty($adaptation)) {
            return $this->sendError('Adaptation not found');
        }

        $adaptation->delete();

        return $this->sendResponse($id, 'Adaptation deleted successfully');
    }
}
