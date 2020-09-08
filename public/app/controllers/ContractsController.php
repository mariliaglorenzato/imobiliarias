<?php
namespace App\Controllers;

use App\Exceptions\ApplicationException;
use Psr\Http\Message\ResponseFactoryInterface;

class ContractsController extends BaseController {


    public function __construct($container) {
        parent::__construct($container);
    }

    public function get(int $id = null) {
        try {
            if (isset($_GET['draw']))   $draw = filter_var($_GET['draw'], FILTER_SANITIZE_STRING);

            if (!is_null($id)) {
                $query = 'contratos?id=' . $id . '&pagina=' . $draw;
                $response = $this->container->client->request('GET', $query);
                if ($response->getStatusCode() == '200') {
                    $responseBody = $response->getBody()->getContents();
                    if (!empty($responseBody)) {
                        return $responseBody;
                    }
                } else throw new ApplicationException($response->getReasonPhrase());
            } else {
                $query = 'contratos?&pagina=' . $draw;
                $response = $this->container->client->request('GET', $query);
                if ($response->getStatusCode() == '200') {
                    $responseBody = $response->getBody()->getContents();
                    if (!empty($responseBody)) {
                        $responseBody = json_decode($responseBody);
                        $responseBody->draw = $draw;
                        $responseBody->recordsTotal = 1000;
                        $responseBody->recordsFiltered = 1000;
                        return json_encode($responseBody);
                    }
                } else throw new ApplicationException($response->getReasonPhrase());
            }
        } catch (\Exception $ex) {
            var_dump($ex->getMessage());
        }
    }

    public function post() {
        $this->data  = $this->filterData();
        try {
            $response = $this->container->client->request('POST', 'locatarios', [
                'body' => json_encode($this->data)
            ]);
            if ($response->getStatusCode() == '200') {
                $responseBody = $response->getBody()->getContents();
                if (!empty($responseBody)) {
                    $responseBody =json_decode($responseBody);
                    return json_encode($responseBody);
                }
            } else throw new ApplicationException($response->getReasonPhrase());
        } catch (\Exception $ex) {
            var_dump($ex->getMessage());
        }
    }

    private function filterData() {

        
        $bodyRequest = [
            // {
            //     "ID_IMOVEL_IMO": "444",
            //     "ID_TIPO_CON": "1",
            //     "DT_INICIO_CON": "06/28/2019",
            //     "DT_FIM_CON": "12/27/2021",
            //     "VL_ALUGUEL_CON": "1800",
            //     "TX_ADM_CON": "10",
            //     "FL_TXADMVALORFIXO_CON": "0",
            //     "NM_DIAVENCIMENTO_CON": "25",
            //     "INQUILINOS[0][ID_PESSOA_PES]": "400",
            //     "INQUILINOS[0][FL_PRINCIPAL_INQ]": "1",
            //     "INQUILINOS[0][NM_FRACAO_INQ]": "100",
            //     "TX_LOCACAO_CON": "0",
            //     "ID_INDICEREAJUSTE_CON": "1",
            //     "NM_MESREAJUSTE_CON": "6",
            //     "DT_ULTIMOREAJUSTE_CON": "06/01/2019",
            //     "FL_MESFECHADO_CON": "0",
            //     "ID_CONTABANCO_CB": "76",
            //     "FL_DIAFIXOREPASSE_CON": "0",
            //     "NM_DIAREPASSE_CON": "5",
            //     "FL_MESVENCIDO_CON": "0",
            //     "FL_DIMOB_CON": "0",
            //     "ID_FILIAL_FIL": "0",
            //     "ST_OBSERVACAO_CON": "Contrato cadastrado via API",
            //     "NM_REPASSEGARANTIDO_CON": "0",
            //     "FL_GARANTIA_CON": "0",
            //     "FL_SEGUROINCENDIO_CON": "0",
            //     "FL_ENDCOBRANCA_CON": "0"
            //   }
        ];

        if (isset($_POST['ID_PESSOA_PES']))
            $bodyRequest['ID_PESSOA_PES'] = filter_var($_POST['ID_PESSOA_PES'], FILTER_SANITIZE_STRING);

        return $bodyRequest;
    }

    public function put() {
    }

}
?>