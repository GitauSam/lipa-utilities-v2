<?php 

namespace App\Models\Utility\Repository;

use App\Models\Utility\UtilityPaymentMethod;

class UtilityPaymentMethodRepository
{

    public function __construct()
    {
        $this->model = new UtilityPaymentMethod();
    }

    public function save($utility, $name, $paybillNo)
    {
        return $this->model->create(
            array(
                "utility_id" => $utility,
                "payment_method_name" => $name,
                "lipa_na_mpesa_paybill" =>$paybillNo,
                "status" => 1
            )
        );
    }

    public function deactivate($u)
    {
        $u->status = 0;
        
        $u->save();

        return $u;
    }

    public function reactivate($u, $paybillNo)
    {
        $u->lipa_na_mpesa_paybill = $paybillNo;
        $u->status = 1;
        
        $u->save();

        return $u;
    }

}

?>