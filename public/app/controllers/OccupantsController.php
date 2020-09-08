<?php
namespace App\Controllers;

use App\Exceptions\ApplicationException;
use Psr\Http\Message\ResponseFactoryInterface;

class OccupantsController extends BaseController {

    //filtered $_POST request body
    protected Array $data;

    public function __construct($container) {
        parent::__construct($container);
    }

    public function get() {
        if (isset($_GET['draw']))   $draw = filter_var($_GET['draw'], FILTER_SANITIZE_STRING);
        if (isset($_GET['ID_PESSOA_PES'])) {
            $query = 'locatarios?&pagina=' . $draw;
            $response = $this->container->client->request('GET', $query);
            if ($response->getStatusCode() == '200') {
                $responseBody = $response->getBody()->getContents();
            }
        } else {
            $query = 'locatarios?&pagina=' . $draw;
            $response = $this->container->client->request('GET', $query);
            if ($response->getStatusCode() == '200') {
                $responseBody = $response->getBody()->getContents();
            } else throw new ApplicationException($response->getReasonPhrase());
        }

        if (!empty($responseBody)) {
            $responseBody = json_decode($responseBody);
            $responseBody->draw = $draw;
            $responseBody->recordsTotal = 1000; //mocked, still need to get counter from api
            $responseBody->recordsFiltered = 1000; //mocked, still need to get counter from api
            return json_encode($responseBody);
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

    public function put() {
        $this->data  = $this->filterData();
        try {
            $response = $this->container->client->request('PUT', 'locatarios', [
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
        $bodyRequest = [];
        if (isset($_POST['ST_NOME_PES']))
            $bodyRequest['ST_NOME_PES'] =  filter_var($_POST['ST_NOME_PES'], FILTER_SANITIZE_STRING);
        if (isset($_POST['ST_FANTASIA_PES']))
            $bodyRequest['ST_FANTASIA_PES'] =  filter_var($_POST['ST_FANTASIA_PES'], FILTER_SANITIZE_STRING);
        if (isset($_POST['ST_CNPJ_PES']))
            $bodyRequest['ST_CNPJ_PES'] =  filter_var($_POST['ST_CNPJ_PES'], FILTER_SANITIZE_STRING);
        if (isset($_POST['ST_CELULAR_PES']))
            $bodyRequest['ST_CELULAR_PES'] =  filter_var($_POST['ST_CELULAR_PES'], FILTER_SANITIZE_STRING);
        if (isset($_POST['ST_TELEFONE_PES']))
            $bodyRequest['ST_TELEFONE_PES'] =  filter_var($_POST['ST_TELEFONE_PES'], FILTER_SANITIZE_STRING);
        if (isset($_POST['ST_EMAIL_PES']))
            $bodyRequest['ST_EMAIL_PES'] =  filter_var($_POST['ST_EMAIL_PES'], FILTER_SANITIZE_STRING);
        if (isset($_POST['ST_RG_PES']))
            $bodyRequest['ST_RG_PES'] =  filter_var($_POST['ST_RG_PES'], FILTER_SANITIZE_STRING);
        if (isset($_POST['ST_ORGÃO_PES']))
            $bodyRequest['ST_ORGÃO_PES'] =  filter_var($_POST['ST_ORGÃO_PES'], FILTER_SANITIZE_STRING);
        if (isset($_POST['ST_SEXO_PES']))
            $bodyRequest['ST_SEXO_PES'] =  filter_var($_POST['ST_SEXO_PES'], FILTER_SANITIZE_STRING);
        if (isset($_POST['DT_NASCIMENTO_PES']))
            $bodyRequest['DT_NASCIMENTO_PES'] =  filter_var($_POST['DT_NASCIMENTO_PES'], FILTER_SANITIZE_STRING);
        if (isset($_POST['ST_NACIONALIDADE_PES']))
            $bodyRequest['ST_NACIONALIDADE_PES'] =  filter_var($_POST['ST_NACIONALIDADE_PES'], FILTER_SANITIZE_STRING);
        if (isset($_POST['ST_CEP_PES']))
            $bodyRequest['ST_CEP_PES'] =  filter_var($_POST['ST_CEP_PES'], FILTER_SANITIZE_STRING);
        if (isset($_POST['ST_ENDERECO_PES']))
            $bodyRequest['ST_ENDERECO_PES'] =  filter_var($_POST['ST_ENDERECO_PES'], FILTER_SANITIZE_STRING);
        if (isset($_POST['ST_NUMERO_PES']))
            $bodyRequest['ST_NUMERO_PES'] =  filter_var($_POST['ST_NUMERO_PES'], FILTER_SANITIZE_STRING);
        if (isset($_POST['ST_COMPLEMENTO_PES']))
            $bodyRequest['ST_COMPLEMENTO_PES'] =  filter_var($_POST['ST_COMPLEMENTO_PES'], FILTER_SANITIZE_STRING);
        if (isset($_POST['ST_BAIRRO_PES']))
            $bodyRequest['ST_BAIRRO_PES'] =  filter_var($_POST['ST_BAIRRO_PES'], FILTER_SANITIZE_STRING);
        if (isset($_POST['ST_CIDADE_PES']))
            $bodyRequest['ST_CIDADE_PES'] =  filter_var($_POST['ST_CIDADE_PES'], FILTER_SANITIZE_STRING);
        if (isset($_POST['ST_ESTADO_PES']))
            $bodyRequest['ST_ESTADO_PES'] =  filter_var($_POST['ST_ESTADO_PES'], FILTER_SANITIZE_STRING);
        if (isset($_POST['ST_OBSERVACAO_PES']))
            $bodyRequest['ST_OBSERVACAO_PES'] =  filter_var($_POST['ST_OBSERVACAO_PES'], FILTER_SANITIZE_STRING);

        return $bodyRequest;
    }
}
?>