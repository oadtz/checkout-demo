<!doctype html>
<html lang="en">
	<head>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
		<title>Simple Payment Gateway</title>
	</head>
	<body>
		<div class="col-md-6 offset-md-3">
		<span class="anchor" id="formPayment"></span>
		<hr class="my-5">
		<!-- form card cc payment -->
		<div class="card card-outline-secondary">
			<div class="card-body">
				<h3 class="text-center">Credit Card Payment</h3>
				<hr>
				<section id="alert">
				</section>
				<form id="checkout" class="form" role="form" autocomplete="off">
					<div class="form-group">
						<label for="cc_name">Customer Name</label>
						<input type="text" class="form-control" id="customer_name" name="customer_name" title="First and last name" required="required">
					</div>
					<div class="row">
						<label class="col-md-12">Amount</label>
					</div>
					<div class="form-group row">
						<div class="col-md-4">
							<input type="number" id="amount" name="amount" class="form-control" value="1.00" placeholder="0.00" min="1.00" required="required">
						</div>
						<div class="col-md-4">
							<select id="currency" name="currency" class="form-control" size="0">
                            @foreach ($currencies as $i)
								<option value="{{$i}}">{{$i}}</option>
                            @endforeach
							</select>
						</div>
					</div>
					<hr/>
					<div class="form-group">
						<label for="cc_name">Card Holder's Name</label>
						<input type="text" id="card_holder_name" name="card_holder_name" class="form-control" title="First and last name" required="required">
					</div>
					<div class="form-group">
						<label>Card Number</label>
						<input type="text" id="card_number" name="card_number" class="form-control" autocomplete="off" maxlength="20" title="Credit card number" required="required">
					</div>
					<div class="form-group row">
						<label class="col-md-12">Card Exp. Date</label>
						<div class="col-md-4">
							<select id="card_expiry_month" name="card_expiry_month" class="form-control">
                            @for ($i = 1; $i <= 12; $i++)
								<option value="{{str_pad($i, 2, '0', STR_PAD_LEFT)}}">{{str_pad($i, 2, '0', STR_PAD_LEFT)}}</option>
                            @endfor
							</select>
						</div>
						<div class="col-md-4">
							<select id="card_expiry_year" name="card_expiry_year" class="form-control">
                            {{$currentYear}}
                            @for ($i = 2018; $i <= $currentYear + 10; $i++)
								<option value="{{$i}}">{{$i}}</option>
                            @endfor
							</select>
						</div>
						<div class="col-md-4">
							<input id="card_cvv" name="card_cvv" type="text" class="form-control" autocomplete="off" maxlength="4" pattern="\d{3,4}" title="Three(or four) digits at back of your card" required="required" placeholder="CVV2 / CVC3 / CID">
						</div>
					</div>
					<hr>
					<div class="form-group row">
						<div class="col-md-6">
							<button type="reset" class="btn btn-default btn-lg btn-block">Reset</button>
						</div>
						<div class="col-md-6">
							<button type="submit" class="btn btn-success btn-lg btn-block">Submit</button>
						</div>
					</div>
				</form>
			</div>
		</div>
		<!-- /form card cc payment -->
		<!-- Optional JavaScript -->
		<!-- jQuery first, then Popper.js, then Bootstrap JS -->
		<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
        <script>
        $(function () {
            $('#checkout').submit(function (e) {
                e.preventDefault ();
                
				$('button[type=submit]').prop('disabled', true);
                $.ajax({
                    type: 'post',
                    url: '/api/checkout',
                    data: $(this).serialize(),
                    dataType: 'json',
                    success: function (response) {
						showAlert ('Success', 'alert-success');
                    },
                    error: function (error) {
						showAlert (error.responseJSON.error || 'Error occured', 'alert-danger');
                    },
					complete: function () {
						$('button[type=submit]').prop('disabled', false);
					}
                });
            });

			$('#card_number').change(function () {
				$(this).val($(this).val().replace(/\s/g, ''));
			});
        });

		function showAlert (message, type) {
			$('#alert').html('');
			$('#alert').append($('<div class="alert p-2 pb-3" data-dismiss="alert" href="#">')
					.addClass(type)
					.append($('<a class="close font-weight-normal initialism" data-dismiss="alert" href="#"><samp>×</samp></a> '))
					.append(message));
		}
        </script>
	</body>
</html>