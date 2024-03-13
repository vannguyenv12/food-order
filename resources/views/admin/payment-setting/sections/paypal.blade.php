<div class="tab-pane fade show active" id="paypal-setting" role="tabpanel" aria-labelledby="home-tab4">
    <div class="card">
        <div class="card-body border">
            <form action="{{ route('admin.general-setting.update') }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="">Paypal Status</label>
                    <select name="status" id="" class="select2 form-control">
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="">Paypal Account Mode</label>
                    <select name="status" id="" class="select2 form-control">
                        <option value="sandbox">Sandbox</option>
                        <option value="live">Live</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="">Paypal Country Name</label>
                    <select name="status" id="" class="select2 form-control">
                        <option value="sandbox">Sandbox</option>
                        <option value="live">Live</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="">Paypal Currency Name</label>

                    <select name="site_default_currency" id="" class="select2 form-control">
                        <option value=""></option>
                        @foreach (config('currencies.currency_list') as $key => $currency)
                            <option @selected(config('settings.site_default_currency') === $currency) value="{{ $currency }}">
                                {{ $currency }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="">Currency Rate</label>
                    <input type="text" class="form-control" name="" value="">
                </div>

                <div class="form-group">
                    <label for="">Paypal Client ID</label>
                    <input type="text" class="form-control" name="" value="">
                </div>

                <div class="form-group">
                    <label for="">Paypal Secret Key</label>
                    <input type="text" class="form-control" name="" value="">
                </div>

                <div class="form-group">
                    <div id="image-preview" class="image-preview">
                        <label for="image-upload" id="image-label">Choose File</label>
                        <input type="file" name="avatar" id="image-upload">
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>
    </div>
</div>
