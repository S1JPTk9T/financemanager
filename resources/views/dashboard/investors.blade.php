@extends('dashboard.main')



@section('content')
<div class="content">
  <div class="row">
      <div class="col-12">
       <div class="card">

        <div class=" simplepaginator-table ppb-2 table-area  search-result-display contact-table">
    			<table id="contatos" class=" table tall-row table-hover mb-0 display nowrap" style="width:90%;" id="contacts-datatable">

          </table>
        </div>

       </div>
     </div>
  </div>
</div>

<style>
.client{
  background-color:#e0fbff;
  color:#00a4bd;
  padding:5px;

}

.font-weight-thick{
  margin-left:10px;
}
</style>
@include('react.cdn')
<script language="javascript">
var meses =
[
"Janeiro",
"Fevereiro",
"Março",
"Abril",
"Maio",
"Junho",
"Julho",
"Agosto",
"Setembro",
"Outubro",
"Novembro",
"Dezembro"
];


function abrev(nome)
{
   let letters = [];
   let inc;
   nome.split(" ").map(l=> { letters.push(l[0]); });
   inc = letters.toString();
   inc = inc.replace(",","");
   inc = inc.toUpperCase();
   return inc;
};

function convertString(at) {
  at = at.split("T")[0];
  [ano,mes,dia] = at.split("-");
  return (dia+", "+meses[parseInt((mes-1))]+" "+ano);
};


</script>
<script type="text/babel">

var listContatos = [ ];

var url = "{{route('listpermission')}}";

const btn = {
  width:'20px'
};

class Contatos extends React.Component {


whatsapp(number) {
  if(number)
  {
    window.open("https://wa.me/+55"+number);
  } else { alert("Este usuário não completo o cadastro!"); };


}

calling(number) {
  if(number)
  {
    let call = "tel:"+number;
    location=call;
  } else { alert("Este usuário não completo o cadastro!"); };


}


destroy(valor) {
let xhr = new XMLHttpRequest();
let option = confirm("deseja excluir este contato??");
alert(this.props.id);
if(option) {
xhr.onload=function(response)  { alert(xhr.responseText); };
xhr.open("get","./?id="+valor,true);
xhr.send();


};


}



render(props){return (
  <tr className="selectable" data-contact="Vys0UDErd1grL1Fyc0pKdDJaZVlpQjhNK1B6Z3VrNWNWMmQ4YVF6ck9uMFRNVEZaZHRzMjdXb1U1OUc3Q0p1ZA==">
      <td>
    	<a href={"{{route('home')}}?form=sim&id"+this.props.nome}>
    		<div className="rounded-circle rounded-initials d-inline-block pmr-1 lead-status client" title={this.props.nome}>
    				{abrev(this.props.nome)}
    		</div>
    		<span data-card-contact-name="" className="font-weight-thick">{this.props.nome}</span>
    	</a>
    </td>
    <td>
     <div className="badge lead-status client">Tipo</div>
    </td>
    <td>
     <div className="contact-tags">
      <span className="badge client">{this.props.cargo}</span>
     </div>
    </td>
    <td>
    	<a href="#" onClick={()=>this.whatsapp(this.props.phone)} className="btn btn-default btn-square waves-effect waves-teal" data-card-wpp-action="">
    		<span className="tim-icons icon-send"></span>
    	</a>
    	<a href="#" onClick={()=>this.calling(this.props.phone)} className="btn btn-default btn-square waves-effect waves-teal" data-card-call-action="">
    		<span className="fa fa-phone"></span>
    	</a>
    </td>
    <td>
    	<div className="dropdown">
    			<a className="btn-action d-block text-center" style={btn} data-toggle="dropdown" href="javascript:alert('oi')" role="button" aria-haspopup="true" aria-expanded="true"><span className="lighter-font fa fa-ellipsis-v"></span><span className="sr-only">Alterar</span></a>
      		<div className="dropdown-menu" x-placement="bottom-start">
      				<a className="dropdown-item" href={"{{route('home')}}?form=sim&id="+this.props.nome}>
        					<span className="fa fa-edit mr-1"></span>Editar
      				</a>
      				<div className="dropdown-divider"></div>
          				<a onClick={()=>this.destroy(this.props.nome)}  data-delete="" className="dropdown-item" href="#">
        					<span className="fa fa-trash-can mr-1"></span>Excluir
          				</a>
        </div>
     </div>
    </td>
  </tr>

)}

};




class BodyContatos extends React.Component {



render(){

return(

  <thead>
      {this.props.contatos}
  </thead>

)}

};

(function (){
  let xhr = new XMLHttpRequest();
  var list = [];
  xhr.onload=function (response)
              {
                  let answer  = JSON.parse(this.responseText);
                  console.log(answer);
                  answer.map(an=> {
                  listContatos.push(<Contatos id={an["model_id"]}nome={an["name"].split(" ")[0]} cargo={an["cargo"]} phone={an["phone"]}/>);
                });

                ReactDOM.render(<BodyContatos contatos={listContatos} />,document.querySelector("#contatos"));

              }
  xhr.open("get",url,true);
  xhr.send();


 }());




</script>

@endsection
