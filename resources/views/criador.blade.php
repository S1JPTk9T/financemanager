==============================================

	criado por : Welington Oliveira

==============================================
<?php
use App\Http\Controllers\Permissions;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Profile as Prof;



$teste = User::create(['name'=>'feokofwek','email'=>'wfekfw@gmail.com','password'=>'oekwofkew']);
$teste->save();
echo $teste->id; 
?>
