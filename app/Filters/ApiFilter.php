<?php

namespace App\Filters;

use Illuminate\Http\Request;

class ApiFilter
{
    protected $safeParams = [];
    protected $columnMap = [];
    protected $operatorMap = [];


    // basado en el transform de la clase ApiFilter el filtro "like" no esta funcionando



    public function transform(Request $request)
    {
        $eloQuery = [];

        foreach ($this->safeParams as $params => $operators) {

            $query = $request->query($params);

            if (!isset($query)) {
                continue;
            }

            $colum = $this->columnMap[$params] ?? $params;

            foreach ($operators as $operator) {
                if (isset($query[$operator])) {

                    if ($operator == 'like') {
                        $query[$operator] = '%' . $query[$operator] . '%';
                    }
                    
                    $eloQuery[] = [$colum, $this->operatorMap[$operator], $query[$operator]];
                }
            }
        }
        return $eloQuery;
    }
}
