@section('production_equipment_create_modal')
{{-- 新增功能Start --}}
<div class="modal fade" id="modal-create">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">新增生產設備圖片</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form id="create_form">
					{{ csrf_field() }}
					<div class="box-body">
						<div class="form-group row">
							<label class="col-sm-2 control-label">圖片</label>
							<div class="col-sm-10">
								<input id="img" type="file" multiple accept="image/*" name="img[]" class="form-control">
								<p class="mt-2">圖片尺寸:<mark>490px X 300px</mark></p>
							</div>
						</div>
					</div>
					<button type="submit" class="btn btn-secondary float-right">儲存</button>
				</form>
			</div>
		</div>
	</div>
</div>
{{-- 新增功能End --}}
@endsection
@push('script')
<script type="text/javascript">
	document.getElementById("img").required = true;
	function production_equipment_create(){
		$('.create').click(function(){
			$('#modal-create').modal('show');
			document.getElementById('create_form').reset();
		})
	}
	$('#create_form').submit(function(){
		var formdata = new FormData(this);
		$.ajax({
			type:"POST",
			url:'{{ asset("admin/production_equipment")}}',
			dataType:'json',
			data:formdata,
			async: false,
			cache: false,
			processData: false,
			contentType: false,
			success: function (e) {
				Swal.fire(
					e.message,
					'已新增圖片。',
					e.status
				);
				$('#modal-create').modal('hide');
				var data = {};
				production_equipment_list(data);
			}
		})
		return false;
	});
</script>
@endpush