@section('contact_show_modal')
<div class="modal fade" id="modal-show">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">表單詳情</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form id="show_form">
					<div class="form-group row">
						<label class="col-sm-2 control-label">公司名稱</label>
						<div class="col-sm-10">
							<input type="text" class="form-control company" readonly>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 control-label">聯絡人</label>
						<div class="col-sm-10">
							<input type="text" class="form-control contact_person" readonly>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 control-label">電話</label>
						<div class="col-sm-10">
							<input type="text" class="form-control phone" readonly>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 control-label">地址</label>
						<div class="col-sm-10">
							<input type="text" class="form-control address" readonly>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 control-label">產品類別</label>
						<div class="col-sm-10">
							<input type="text" class="form-control product_category" readonly>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 control-label">產品規格</label>
						<div class="col-sm-10">
							<input type="text" class="form-control product_specification" readonly>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 control-label">容器材質</label>
						<div class="col-sm-10">
							<input type="text" class="form-control container_material" readonly>
						</div>
					</div>
					<div class="form-group row">
						<label class="col-sm-2 control-label">所裝內容物</label>
						<div class="col-sm-10">
							<input type="text" class="form-control contents" readonly>
						</div>
					</div>
					<div class="form-group row">
							<label class="col-sm-2 control-label">訊息</label>
							<div class="col-sm-10">
								<textarea class="form-control message" readonly></textarea>
							</div>
						</div>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection
@push('script')
<script type="text/javascript">
	function contact_show(){
		$('.show').click(function(){
			$('#modal-show').modal('show');
			$('#modal-show').on('hidden.bs.modal',function(){
				document.getElementById('show_form').reset();
			});
			var contact_id = $(this).data('id');
			$.ajax({
				type:"GET",
				url:'{{ asset("admin/contact")}}/'+contact_id,
				dataType:'json',
				success: function (e) {
					$.each(e,function(k,v){
						$('.'+k).val(v);
					});
					$('#modal-show').modal('hide');
				}
			})
		})
	}
</script>
@endpush