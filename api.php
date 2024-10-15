<?php 
ini_set('display_errors', 0);
error_reporting(0);

Class Signo{
    public function verificaSigno(){
        if(!isset($_POST['dt_nasc']) || $_POST['dt_nasc'] == '' || $_POST['dt_nasc'] == '0000-00-00'){
            echo "Preencha com a data de nascimento.";
            throw new Exception();
        }
        $dt_nasc = filter_input(INPUT_POST, 'dt_nasc');
        $dt_nasc = DateTime::createFromFormat('Y-m-d', $dt_nasc);
        if(!$dt_nasc || $dt_nasc->format('Y-m-d') !== $dt_nasc){
            echo "Boa tentativa. Data inválida.";
            throw new Exception();
        }
        $dt_nasc = $dt_nasc->format('m-d');
    
        $signos = simplexml_load_file("signos.xml");
    
        for($i = 0; $i < count($signos->Signo); $i++){
            $signo = $signos->Signo[$i];
            $dt_nasc = (int)str_replace('-', '', $dt_nasc);
            $dt_inc = (int)str_replace('-', '',$signo->inicio); 
            $dt_fim = (int)str_replace('-', '',$signo->fim);
            if($dt_inc <= $dt_fim){
                if($dt_nasc >= $dt_inc && $dt_nasc <= $dt_fim){
                    echo json_encode($signo->nome);
                    break;
                }
            }else{
                if($dt_nasc >= $dt_inc || $dt_nasc <= $dt_fim){
                    echo json_encode($signo->nome);
                    break;
                }
            }
        }
    }
}
$s = new Signo();
echo $s->verificaSigno();


// echo $dt_nasc;
// echo json_encode($signos->Signo);
