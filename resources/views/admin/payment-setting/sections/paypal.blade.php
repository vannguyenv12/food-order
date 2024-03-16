<div class="tab-pane fade show active" id="paypal-setting" role="tabpanel" aria-labelledby="home-tab4">
    <div class="card">
        <div class="card-body border">
            <form action="{{ route('admin.payment-setting.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="">Paypal Status</label>
                    <select name="paypal_status" id="" class="select2 form-control">
                        <option @selected(@$paymentGateway['paypal_status'] == 1) value="1">Active</option>
                        <option @selected(@$paymentGateway['paypal_status'] == 0) value="0">Inactive</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="">Paypal Account Mode</label>
                    <select name="paypal_account_mode" id="" class="select2 form-control">
                        <option @selected(@$paymentGateway['paypal_account_mode'] == 'sandbox') value="sandbox">Sandbox</option>
                        <option @selected(@$paymentGateway['paypal_account_mode'] == 'live') value="live">Live</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="">Paypal Country Name</label>
                    <select name="paypal_country_name" id="" class="select2 form-control">
                        <option value="">Select</option>
                        @foreach (config('country_list') as $key => $country)
                            <option @selected(@$paymentGateway['paypal_country_name'] === $key) value="{{ $key }}">
                                {{ $country }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="">Paypal Currency Name</label>

                    <select name="paypal_currency" id="" class="select2 form-control">
                        <option value=""></option>
                        @foreach (config('currencies.currency_list') as $key => $currency)
                            <option @selected(@$paymentGateway['paypal_currency'] === $currency) value="{{ $currency }}">
                                {{ $currency }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="">Currency Rate (Per {{ config('settings.site_default_currency') }})</label>
                    <input type="text" class="form-control" name="paypal_rate"
                        value="{{ @$paymentGateway['paypal_rate'] }}">
                </div>

                <div class="form-group">
                    <label for="">Paypal Client ID</label>
                    <input type="text" class="form-control" name="paypal_api_key"
                        value="{{ @$paymentGateway['paypal_api_key'] }}">
                </div>

                <div class="form-group">
                    <label for="">Paypal Secret Key</label>
                    <input type="text" class="form-control" name="paypal_secret_id"
                        value="{{ @$paymentGateway['paypal_secret_id'] }}">
                </div>

                <div class="form-group">
                    <label for="">Paypal App ID</label>
                    <input type="text" class="form-control" name="paypal_app_id"
                        value="{{ @$paymentGateway['paypal_app_id'] }}">
                </div>

                <div class="form-group">
                    <label for="">Paypal Logo</label>
                    <div id="image-preview" class="image-preview">
                        <label for="image-upload" id="image-label">Choose File</label>
                        <input type="file" name="paypal_logo" id="image-upload">
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        $(document).ready(function() {
            $('.image-preview').css({
                'background-image': `url({{ asset($paymentGateway['paypal_logo']) }})`,
                'background-size': 'cover',
                'background-position': 'center center',
            })
        })
    </script>
@endpush
