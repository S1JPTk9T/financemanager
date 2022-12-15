@extends('dashboard.main')

@section('content')
<div class="content">
  <div class="row ">
    <div class="col-md-3 offset-md-9">
      <button id="createFund" type="button"  class="btn btn-primary btn-lg " style="background-color:#3358f4 !important;">Adicionar Fundo</button>
    </div>
      <div style="margin-top:50px;" class="col-12">
       <div class="card">
        <div class=" simplepaginator-table ppb-2 table-area  search-result-display contact-table">
    			<table id="contatos" class=" table tall-row table-hover mb-0 display nowrap" style="width:90%;" id="contacts-datatable">

          </table>
        </div>

       </div>
     </div>


      <div id="myModal" class="modal">
        <div class="formFund">
          <form id="formUser" method="post" action="{{route('createFund')}}">
            @csrf
                <div class="row justify-content-md-center">
                  <div class="col-md-8">
                    <div class="card">
                      <div class="card-header">
                        <h5 class="title">Fundo</h5>
                      </div>
                      <div class="card-body">
                        <form>
                          <div class="row">
                            <div class="col-md-5 pr-md-1">
                              <div class="form-group">
                                <label>Sigla</label>
                                <input required id="abrev" name="abrev" type="text" class="form-control"  placeholder="PETR4">
                              </div>
                            </div>
                            <div class="col-md-3 px-md-1">
                              <div class="form-group">
                                <label>Cotação</label>
                                <input required id="cotado" name="cotado" type="text" class="form-control" placeholder="32,73" >
                              </div>
                            </div>
                            <div class="col-md-4 pl-md-1">
                              <div class="form-group">
                                <label for="exampleInputEmail1">Fundo</label>
                                <input required id="investido" name="investido" type="text" class="form-control" placeholder="32,73" >
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-5 pr-md-1">
                              <select required name="user_id" id="listInvestors" class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">

                              </select>
                            </div>
                          </div>
                        </form>
                      </div>
                      <div class="card-footer">
                        <button type="submit" id="saveFund" class="btn btn-fill btn-primary">Guardar</button>
                        <button type="button" id="closeFund" class="btn btn-fill btn-secondary">Fechar</button>
                      </div>
                    </div>
                  </div>
                </div>
                </form>
              </div>

        </div>
        <div id="caption"></div>
      </div>


  </div>
</div>


<style>
td{
  cursor:pointer;
}
#myImg {
  border-radius: 5px;
  cursor: pointer;
  transition: 0.3s;
}

#myImg:hover {opacity: 0.7;}

/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 100px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.9); /* Black w/ opacity */
}

/* Modal Content (image) */
.modal-content {
  margin: auto;
  display: block;
  width: 80%;
  max-width: 700px;
}

/* Caption of Modal Image */
#caption {
  margin: auto;
  display: block;
  width: 80%;
  max-width: 700px;
  text-align: center;
  color: #ccc;
  padding: 10px 0;
  height: 150px;
}

/* Add Animation */
.modal-content, #caption {
  animation-name: zoom;
  animation-duration: 0.6s;
}

@keyframes zoom {
  from {transform: scale(0.1)}
  to {transform: scale(1)}
}

/* The Close Button */
.close {
  position: absolute;
  top: 100px;
  right: 35px;
  color: #f1f1f1;
  font-size: 40px;
  font-weight: bold;
  transition: 0.3s;
}

.close:hover,
.close:focus {
  color: #bbb;
  text-decoration: none;
  cursor: pointer;
}

/* 100% Image Width on Smaller Screens */
@media only screen and (max-width: 700px){
  .modal-content {
    width: 100%;
  }
}
</style>

<style>
.client{
  background-color:#e0fbff;
  color:#00a4bd;
  padding:5px;
  font-size:15px;

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



let formUser = document.querySelector("#formUser");
let createFund = document.querySelector("#createFund");
let closeFund = document.querySelector("#closeFund");
var captionText = document.getElementById("caption");
var modal = document.getElementById('myModal');
var urlInvestors = "{{route('listpermission')}}";

function showForm() {
  var abrev = document.querySelector("#abrev");
  var cotado = document.querySelector("#cotado");
  var investido = document.querySelector("#investido");

  modal.style.display = "block";

  return [abrev,cotado,investido];
};

var listContatos = [ ];

var url = "{{route('listfunds')}}";

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

editable(props) {
  formUser.method="post";
  formUser.action="{{route('updateFund')}}?id="+this.props.id+"&wid="+this.props.wid;
  let input = showForm();
  input[0].value = this.props.abrev;
  input[1].value = this.props.cotado;
  input[2].value = this.props.investido;




}

destroy(id) {
let option = confirm("deseja excluir este contato??");
if(id && option == true)
{

  let xhr = new XMLHttpRequest();
  let deleteForm = new FormData();
  let token = document.getElementsByName("_token")[0].value;
  deleteForm.append("id",id);
  deleteForm.append("_token",token);
  xhr.onload=function(response) {alert(this.responseText);  location.reload();};
  xhr.open("post","{{route('deleteFund')}}",true);
  xhr.send(deleteForm);

} else { alert("não sera apagado!"); };





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
      <span className="badge client">{this.props.abrev}</span>
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
      <p>Cotação</p>{this.props.cotado}
    </td>
    <td>
      <p>Fundo</p>{this.props.investido}
    </td>
    <td>
      <p>Criado</p>{this.props.data}
    </td>
    <td>
    	<div className="dropdown">
    			<a className="btn-action d-block text-center" style={btn} data-toggle="dropdown" href="javascript:alert('oi')" role="button" aria-haspopup="true" aria-expanded="true"><span className="lighter-font fa fa-ellipsis-v"></span><span className="sr-only">Alterar</span></a>
      		<div className="dropdown-menu" x-placement="bottom-start">
      				<a onClick={()=>this.editable()} className="dropdown-item" href="#">
        					<span className="fa fa-edit mr-1"></span>Editar
      				</a>
      				<div className="dropdown-divider"></div>
          				<a onClick={()=>this.destroy(this.props.wid)}  data-delete="" className="dropdown-item" href="#">
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


createFund.addEventListener("click",function ()  {
  formUser.method="post";
  formUser.action=location.href;
  let input =  showForm();
  input.map((i)=> {i.value=""; })
});


closeFund.addEventListener("click",function(){
  modal.style.display = "none";
});



(function (){
   let listInvestors = document.querySelector("#listInvestors");
       let investors = new XMLHttpRequest();
           investors.onload=function(response)
           {
              if(this.responseText)
              {
                let loadInvestors = JSON.parse(this.responseText);
                    loadInvestors.map((inv)=> {
                      let option = document.createElement("option");
                          option.append(document.createTextNode(inv["name"]));
                          option.value=inv['model_id'];
                          listInvestors.appendChild(option);
                    });
              };

           };
           investors.open("get",urlInvestors,true);
           investors.send();

  let xhr = new XMLHttpRequest();
  var list = [];
  xhr.onload=function (response)
              {
                  let answer  = JSON.parse(this.responseText);
                  console.log(answer);
                  answer.map(an=> {
                  listContatos.push(<Contatos id={an["id"]} wid={an["wid"]} abrev={an["abrev"]} data={an["created_at"]} nome={an["nome"].split(" ")[0]}  phone={an["phone"]} cotado={an["cotado"]} investido={an["investido"]} />);
                });

                ReactDOM.render(<BodyContatos contatos={listContatos} />,document.querySelector("#contatos"));

              }
  xhr.open("get",url,true);
  xhr.send();


 }());




</script>

@endsection
