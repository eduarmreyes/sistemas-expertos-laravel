@extends('layouts.app')

@section('htmlheader_title')
	Catálogo Personas
@endsection

@section("extra_plugin_assets")
	<!-- PNotify -->
	<link href="{{ asset('/css/pnotify.custom.css') }}" rel="stylesheet" type="text/css" />
	<!-- Datepicker -->
	<link href="{{ asset('/plugins/datepicker/datepicker3.css') }}" rel="stylesheet" type="text/css" />
	<!-- iCheck for checkboxes and radio inputs -->
	<link rel="stylesheet" href="{{ asset('/plugins/iCheck/all.css') }}">
	<!-- Datatables -->
	<link rel="stylesheet" href="{{ asset('/plugins/datatables/dataTables.bootstrap.css') }}">
@endsection

@section("extra_plugin_scripts")
	<!-- Datepicker -->
	<script src="{{ asset('/plugins/datepicker/bootstrap-datepicker.js') }}"></script>
	<!-- iCheck 1.0.1 -->
	<script src="{{ asset('/plugins/iCheck/icheck.min.js') }}"></script>
	<!-- PNotify -->
	<script src="{{ asset('/js/pnotify.custom.js') }}" type="text/javascript"></script>
	<!-- DataTables -->
	<script src="{{ asset('/plugins/datatables/jquery.dataTables.min.js') }}" type="text/javascript"></script>
	<script src="{{ asset('/plugins/datatables/dataTables.bootstrap.js') }}" type="text/javascript"></script>
@endsection

@section('main-content')
	<div class="box box-danger">
	  <div class="box-header with-border">
	    <h3 class="box-title">{{ trans('persona.box_title') }}</h3>
	  </div>
	  <!-- /.box-header -->
	  <div class="box-body">
		  <!-- form start -->
		  <form role="form">
		  	<meta name="csrf-token" content="{{ csrf_token() }}">
		    <div class="box-body">
		      <div class="form-group">
		        <label for="txtPersonaNombre">{{ trans("persona.name_label") }}</label>
		        <input type="text" class="form-control" id="txtPersonaNombre" name="txtPersonaNombre" placeholder="{{ trans('persona.name_placeholder') }}">
		      </div>
		      <div class="form-group">
		        <label for="txtPersonaApellidos">{{ trans("persona.surname_label") }}</label>
		        <input type="text" class="form-control" id="txtPersonaApellidos" name="txtPersonaApellidos" placeholder="{{ trans('persona.surname_placeholder') }}">
		      </div>
		      <div class="form-group">
		        <label for="txtPersonaBirthday">{{ trans("persona.birthday_label") }}</label>
		        <div class="input-group date">
		          <div class="input-group-addon">
		            <i class="fa fa-calendar"></i>
		          </div>
		          <input type="text" class="form-control pull-right" id="txtPersonaBirthday" name="txtPersonaBirthday" placeholder="{{ trans('persona.birthday_placeholder') }}">
		        </div>
		        <!-- /.input group -->
		      </div>
		      <div class="form-group">
		        <label for="txtPersonaCorreo">{{ trans("persona.correo_label") }}</label>
		        <input type="email" class="form-control" id="txtPersonaCorreo" name="txtPersonaCorreo" placeholder="{{ trans('persona.correo_placeholder') }}">
		      </div>
		      <div class="row">
		      	<div class="col-md-6">
				      <div class="form-group">
				        <label for="txtPersonaEstatura">{{ trans("persona.height_label") }}</label>
				        <input type="number" class="form-control" id="txtPersonaEstatura" name="txtPersonaEstatura" placeholder="{{ trans('persona.height_placeholder') }}" min="1.30" step="0.1">
				        <p class="help-block">{{ trans("persona.height_help_block") }}</p>
				      </div>
		      	</div>
		      	<div class="col-md-6">
				      <div class="form-group">
				        <label for="txtPersonaPeso">{{ trans("persona.weight_label") }}</label>
				        <input type="number" class="form-control" id="txtPersonaPeso" name="txtPersonaPeso" placeholder="{{ trans('persona.weight_placeholder') }}" min="70" step="10">
				        <p class="help-block">{{ trans("persona.weight_help_block") }}</p>
				      </div>
		      	</div>
		      </div>
		      <!-- /.form group -->
		      <div class="form-group">
		        <label for="chkPersonaSexoMale">{{ trans("persona.sexo_label_male") }}</label>
		        <input type="radio" class="minimal" id="chkPersonaSexoMale" name="chkPersonaSexo" value="m">
		        <label for="chkPersonaSexoFemale">{{ trans("persona.sexo_label_female") }}</label>
		        <input type="radio" class="minimal" id="chkPersonaSexoFemale" name="chkPersonaSexo" value="f">
		      </div>
		    </div>
		    <!-- /.box-body -->

		    <div class="box-footer">
		      <button type="submit" class="btn btn-primary">{{ trans('persona.submit') }}</button>
		    </div>
		  </form>
		  <!-- /.box -->
	  </div>
	  <!-- /.box-body -->
	</div>
	<div class="box box-primary">
		<div class="box-header with-border">
			<h3 class="box-title">{{ trans("persona.box_table_title") }}</h3>
		</div>
	  <!-- /.box-header -->
		<div class="box-body">
			<table id="tbPersona" class="table table-bordered table-hover">
				<caption>{{ trans("persona.table_caption") }}</caption>
				<thead>
					<tr>
						<th>{{ trans("persona.thead_names") }}</th>
						<th>{{ trans("persona.thead_surnames") }}</th>
						<th>{{ trans("persona.thead_birthday") }}</th>
						<th>{{ trans("persona.thead_email") }}</th>
						<th>{{ trans("persona.thead_height") }}</th>
						<th>{{ trans("persona.thead_weight") }}</th>
						<th>{{ trans("persona.thead_sex") }}</th>
						<th>{{ trans("persona.thead_actions") }}</th>
					</tr>
				</thead>
				<tbody>
				</tbody>
				<tfoot>
					<tr>
						<th>{{ trans("persona.thead_names") }}</th>
						<th>{{ trans("persona.thead_surnames") }}</th>
						<th>{{ trans("persona.thead_birthday") }}</th>
						<th>{{ trans("persona.thead_email") }}</th>
						<th>{{ trans("persona.thead_height") }}</th>
						<th>{{ trans("persona.thead_weight") }}</th>
						<th>{{ trans("persona.thead_sex") }}</th>
						<th>{{ trans("persona.thead_actions") }}</th>
					</tr>
				</tfoot>
			</table>
		</div>
	</div>
@endsection

@section("additional_scripts")
<script>
	$(function () {
		$(document).on("ready", function() {
			// ajax setup
			$.ajaxSetup({
			    headers: {
			        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			    }
			});
			var tbPersona = null;
			//Date picker
			$('#txtPersonaBirthday').datepicker({
			  autoclose: true,
			  startView: 2
			});
			//iCheck for checkbox and radio inputs
			$('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
			  checkboxClass: 'icheckbox_minimal-red',
			  radioClass: 'iradio_minimal-red'
			});
			// ajax to get all personas from database
			$.ajax({
				dataType: "json",
				error: function(data) {
					console.log(data);
				},
				success: function(data) {
					var oNotify = null;
					if (data.personas.length > 0) {
						$.each(data.personas, function(i, rows) {
							var sSexoLabel = (rows.Sexo === "m") ? '<span class="label label-primary">' + rows.Sexo + '</label>' : '<span class="label label-warning">' + rows.Sexo + '</label>';
							var codigo = "<tr data-persona-id='" + rows.id + "'><td> <i class='fa fa-user' aria-hidden='true'></i> " + rows.Nombres + "</td><td>" + rows.Apellidos + "</td><td><i class='fa fa-birthday-cake' aria-hidden='true'></i> " + rows.FechaNacimiento + "</td><td>" + rows.Correo + "</td><td>" + rows.Estatura + "</td><td>" + rows.Peso + "</td><td>" + sSexoLabel + "</td><td><button data-persona-id='" + rows.id + "' class='btnEditar btn btn-info'>Editar</button> - <button data-persona-id='" + rows.id + "' class='btnEliminar btn btn-danger'>Eliminar</button></td></tr>";
							$("#tbPersona>tbody").append(codigo);
						});
						tbPersona = $("#tbPersona").DataTable();
						oNotify = {
						    title: "{{ trans('persona.persona_from_db_notify_title') }}",
						    text: "{{ trans('persona.persona_from_db_notify_text') }}",
						    type: "info"
						};
					} else {
						oNotify = {
						    title: "{{ trans('persona.no_persona_from_db_notify_title') }}",
						    text: "{{ trans('persona.no_persona_from_db_notify_text') }}",
						    type: "info"
						};
					}
          new PNotify(oNotify);
				},
				type: "get",
				url: "{{ url('/personas/getPersonas') }}"
			});
			// save persona to db
			$("form").on("submit", function(e) {
				$(".has-error").removeClass("has-error");
				$.ajax({
					data: $(this).serialize() + "&id=" + $(this).data("id_persona"),
					dataType: "json",
					error: function(data) {
						if (data.status === 422) {
							// required fields
							var dataJson = data.responseJSON;
							$.each(dataJson, function(o) {
								$("#" + o).parent().closest("div.form-group").addClass("has-error");
								new PNotify({
									title: "Cuidado",
									text: this[0]
								});
							});
						}
					},
					success: function(data) {
						$("#_token").val(data.csrf_token);
						var sSexoLabel = (data.persona.Sexo === "m") ? '<span class="label label-primary">' + data.persona.Sexo + '</label>' : '<span class="label label-warning">' + data.persona.Sexo + '</label>';
						var aData = [
							  "<i class='fa fa-user' aria-hidden='true'></i> " + data.persona.Nombres,
								data.persona.Apellidos,
								"<i class='fa fa-birthday-cake' aria-hidden='true'></i> " + data.persona.FechaNacimiento,
								data.persona.Correo,
								data.persona.Estatura,
								data.persona.Peso,
								sSexoLabel,
								"<button data-persona-id='" + data.persona.id + "' class='btnEditar btn btn-info'>Editar</button> - <button data-persona-id='" + data.persona.id + "' class='btnEliminar btn btn-danger'>Eliminar</button>"
			       ];
						if (data.is_new) {
							$("#tbPersona").DataTable().row.add(aData).draw(false);
						} else {
							var row = tbPersona.row("[data-persona-id=" + data.persona.id + "]");
							row.data(aData).draw(false);
						}
						new PNotify({
							title: "Éxito",
							text: "La persona " + data.persona.Nombres + " tiene su información al día",
							type: "success"
						});
						fnClearForm();
					},
					type: "post",
					url: "{{ url('/personas/savePersonas') }}"
				});

				e.preventDefault();
			});
			// click on edit
			$("#tbPersona").on("click", ".btnEditar", function(e) {
				// get persona from db
				$.ajax({
					data: "id=" + $(this).data("persona-id"),
					dataType: "json",
					error: function(data) {
						//
						console.log(data);
					},
					success: function(data) {
						//
						if (data.success) {
							//
							$("#txtPersonaNombre").val(data.personas[0].Nombres);
							$("#txtPersonaApellidos").val(data.personas[0].Apellidos);
							var oPersonaBirthday = new Date(data.personas[0].FechaNacimiento);
							var sPersonaBirthday = (oPersonaBirthday.getMonth() + 1) + "/" + oPersonaBirthday.getDate() + "/" + oPersonaBirthday.getFullYear();
							$("#txtPersonaBirthday").val(sPersonaBirthday);
							$("#txtPersonaCorreo").val(data.personas[0].Correo);
							$("#txtPersonaEstatura").val(data.personas[0].Estatura);
							$("#txtPersonaPeso").val(data.personas[0].Peso);
							$("#chkPersonaSexoMale").prop("checked", (data.personas[0].Sexo === "m"));
							$("#chkPersonaSexoFemale").prop("checked", (data.personas[0].Sexo === "f"));
							$(".minimal").iCheck('update');
							$("form").data("id_persona", data.personas[0].id);
						}
					},
					type: "get",
					url: "{{ url('/personas/getPersonas') }}"
				});
				e.preventDefault();
			});
			// click on delete
			$("#tbPersona").on("click", ".btnEliminar", function(e) {
				// get persona from db
				$.ajax({
					data: "id=" + $(this).data("persona-id"),
					dataType: "json",
					error: function(data) {
						//
						console.log(data);
					},
					success: function(data) {
						//
						if (data.success) {
							//
							var row = tbPersona.row("[data-persona-id=" + data.persona.id + "]");
							row.remove().draw(false);
						}
					},
					type: "delete",
					url: "{{ url('/personas/deletePersona') }}"
				});
				e.preventDefault();
			});
			function fnClearForm() {
				$("input").val("");
				$("input[type=radio],input[type=checkbox]").iCheck("uncheck");
				$("#chkPersonaSexoFemale").val("f")
				$("#chkPersonaSexoMale").val("m")
			}
		});
	});
</script>

@endsection