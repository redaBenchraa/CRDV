<?php

namespace App\Http\Controllers\API;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\API\CreateSerafinAPIRequest;
use App\Http\Requests\API\UpdateSerafinAPIRequest;
use App\Models\Serafin;
use App\Repositories\SerafinRepository;
use App\Repositories\CategorieRepository;
use App\Repositories\SousCategorieRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class ExcelAPIController
 * @package App\Http\Controllers\API
 */

class ExcelAPIController extends AppBaseController
{
    private $serafinRepository;
    private $categorieRepository;
    private $sousCategorieRepository;
   

    public function __construct(SerafinRepository $serafinRepo, CategorieRepository $categorieRepo, SousCategorieRepository $sousCategorieRepo)
    {
        $this->serafinRepository = $serafinRepo;
        $this->categorieRepository = $categorieRepo;
        $this->sousCategorieRepository = $sousCategorieRepo;
    }


    //LOAD EXCEL FILE
    public function Load(Request $request)
    {
        if( $request->hasFile('import_file') ){

            $path = $request->file('import_file')->getRealPath();

            $data = Excel::load($path, function($reader) {})->get();
                
            if(!empty($data) && $data->count()){
                foreach($data as $sheet){ 
                    foreach($sheet as $row){

                        
                        $categorieParam = ['centre_id' => 1,'intitule' => $row->keys()->first()];
                        $categorie = $this->categorieRepository->findWhere($categorieParam);
                        if($categorie->isEmpty()){
                            $categorie = $this->categorieRepository->create($categorieParam);
                        }


                        if($row->actes_directs != null && $row->serafin_direct != null && strpos($row->serafin_direct,'.') !== false){

                            $serafinParam = ['code' => $row->serafin_direct,'intitule' => $row->actes_directs];
                            $serafin = $this->serafinRepository->findWhere($serafinParam);
                            if($serafin->isEmpty()){
                                $serafin = $this->serafinRepository->create($serafinParam);
                            }

                            $sousCategorieParam = ['categorie_id' => $categorie->first()->id,
                                            'intitule' => $row->actes_directs,
                                            'type' => 0,
                                            'serafin_id' => $serafin->first()->id];

                            $sousCategorie = $this->sousCategorieRepository->findWhere($sousCategorieParam);
                            if($sousCategorie->isEmpty()){
                                $sousCategorie = $this->sousCategorieRepository->create($sousCategorieParam);
                            }
                        }


                        if($row->actes_indirects != null && $row->serafin_indirect != null  && strpos($row->serafin_indirect,'.') !== false){

                            $serafinParam = ['code' => $row->serafin_indirect,'intitule' => $row->actes_indirects];
                            $serafin = $this->serafinRepository->findWhere($serafinParam);
                            if($serafin->isEmpty()){
                                $serafin = $this->serafinRepository->create($serafinParam);
                            }
                        
                            $sousCategorieParam = ['categorie_id' => $categorie->first()->id,
                                            'intitule' => $row->actes_indirects,
                                            'type' => 1,
                                            'serafin_id' => $serafin->first()->id];

                            $sousCategorie = $this->sousCategorieRepository->findWhere($sousCategorieParam);
                            if($sousCategorie->isEmpty()){
                                $sousCategorie = $this->sousCategorieRepository->create($sousCategorieParam);
                            }

                        }

                    }
                }

                return $this->sendResponse(null, 'Data Loaded');
            }
       
            return $this->sendResponse(null, 'No Data Found');

        }else{
            return $this->sendResponse(null, 'File not Found');
        }    
    }


}
