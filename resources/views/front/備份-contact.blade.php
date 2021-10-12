@include('front.layouts.header')
@include('front.layouts.footer')
@include('front.layouts.loading')
<!DOCTYPE html>
<html>
    @yield('head')
    <body class="contact">
        @yield('loading')
        <div class="fullContainer">
            @yield('header')
            <section class="dist">
                <div class="pageTitle">
                    <h1>CONTACT</h1>
                </div>
                <div class="contactSection">
                    <div class="contactForm">
                        <form class="formCustomStyle" id="addForm">
                            {{ csrf_field() }}
							<div class="row">
								<div class="col-12 col-sm-5">
									<div class="form-group">
										<label for="formName" class="col-form-label">{{ __('message.ContactPerson') }}<span class="text-danger">*</span></label>
										<input type="text" class="form-control" name="contact_person" id="formName" required="">
									</div>
                                    <div class="form-group">
										<label for="formPhone" class="col-form-label">{{ __('message.Phone') }}<span class="text-danger">*</span></label>
										<input type="text" class="form-control" name="phone" id="formPhone" required="">
									</div>
                                    <div class="form-group">
										<label for="formCatalog" class="col-form-label">{{ __('message.ProductCategory') }}</label>
										<input type="text" class="form-control" name="product_category" id="formCatalog">
									</div>
                                    <div class="form-group">
										<label for="formSpecification" class="col-form-label">{{ __('message.ProductSpecification') }}</label>
										<input type="text" class="form-control" name="product_specification" id="formSpecification">
									</div>
                                    <div class="form-group">
										<label for="formMaterial" class="col-form-label">{{ __('message.ContainerMaterial') }}</label>
										<input type="text" class="form-control" name="container_material" id="formMaterial">
									</div>
                                    <div class="form-group">
										<label for="formContents" class="col-form-label">{{ __('message.Contents') }}</label>
										<input type="text" class="form-control" name="contents" id="formContents">
									</div>

								</div>
                                <div class="col-12 col-sm-7">
									<div class="form-group">
										<label for="formCompany" class="col-form-label">{{ __('message.Company') }}<span class="text-danger">*</span></label>
										<input type="text" class="form-control" name="company" id="formCompany" required="">
									</div>
                                    <div class="form-group">
										<label for="formAddress" class="col-form-label">{{ __('message.Address') }}<span class="text-danger">*</span></label>
										<input type="text" class="form-control" name="address" id="formAddress" required="">
									</div>
                                    <div class="form-group">
										<label for="formContent" class="col-form-label">{{ __('message.Message') }}<span class="text-danger">*</span></label>
										<textarea rows="5" class="form-control" name="message" id="formContent" required=""></textarea>
									</div>
                                    <div class="form-group">
										<label for="formCaptcha" class="col-form-label">{{ __('message.Captcha') }}<span class="text-danger">*</span></label>
										<div class="form-row captcha">
											<div class="captchaInput">
												<input type="text" class="form-control" name="captcha" id="formCaptcha" required="">
											</div>
											<img src="{{captcha_src('flat')}}" onclick="this.src='/captcha/flat?'+Math.random()">
										</div>
									</div>
                                    <div class="form-row justify-content-end mt-5 post_form">
                                        {{-- <button type="submit" class="btn btn-primary btnCustom-outline cursor-pointer contactSubmit">送出</button> --}}
                                        <a class="animated-arrow link">
                                            <span class="the-arrow -left">
                                              <span class="shaft"></span>
                                            </span>
                                            <span class="main">
                                              <span class="text">
                                                {{ __('message.Submit') }}
                                              </span>
                                              <span class="the-arrow -right">
                                                <span class="shaft"></span>
                                              </span>
                                            </span>
                                        </a>
                                    </div>
								</div>
							</div>
						</form>
                        <div class="contactDetail">
                            <div class="contactInfo">
                                <div class="contactInfoList">
                                    <h5>{{ __('message.Address') }}</h5>
                                    <span>{{ $address->value }}</span>
                                </div>
                            </div>
                            <div class="contactInfo">
                                <div class="contactInfoList">
                                    <h5>{{ __('message.Phone') }}</h5>
                                    <span>{{ $phone->value }}</span>
                                </div>
                                <div class="contactInfoList">
                                    <h5>{{ __('message.Fax') }}</h5>
                                    <span>{{ $fax->value }}</span>
                                </div>
                                <div class="contactInfoList">
                                    <h5>Email</h5>
                                    <span><a href="mailto:{{ $email->value }}">{{ $email->value }}</a></span>
                                </div>
                            </div>
                            <!-- <div class="test">test</div> -->
                        </div>
                    </div>
                </div>
            </section>
        </div>
        @yield('footer')
    </body>
</html>
<script type="text/javascript">
    $('.post_form').click(function(){
        var data = $('#addForm').serialize();
        $.ajax({
            type:"POST",
            url:'{{ asset("admin/contact")}}',
            dataType:'json',
            data:data,
            success: function (e) {
                Swal.fire(
                    e.message,
                    '已發送。',
                    e.status
                );
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                if(typeof(XMLHttpRequest.responseJSON.errors.captcha) === 'undefined'){
                    Swal.fire(
                        '請填寫必填欄位',
                        '發送失敗。',
                        textStatus
                    );
                }else{
                    Swal.fire(
                        '驗證碼錯誤',
                        '發送失敗。',
                        textStatus
                    );
                }
            },
        })
        return false;
    });
</script>