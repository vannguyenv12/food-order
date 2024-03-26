<div class="tab-pane fade show" id="pusher-setting" role="tabpanel" aria-labelledby="home-tab4">
    <div class="card">
        <div class="card-body border">
            <form action="{{ route('admin.pusher-setting.update') }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="">Pusher App ID</label>
                    <input type="text" class="form-control" name="pusher_app_id"
                        value="{{ config('settings.pusher_app_id') }}">
                </div>
                <div class="form-group">
                    <label for="">Pusher Key</label>
                    <input type="text" class="form-control" name="pusher_key"
                        value="{{ config('settings.pusher_key') }}">
                </div>
                <div class="form-group">
                    <label for="">Pusher Secret</label>
                    <input type="text" class="form-control" name="pusher_secret"
                        value="{{ config('settings.pusher_secret') }}">
                </div>
                <div class="form-group">
                    <label for="">Pusher Cluster</label>
                    <input type="text" class="form-control" name="pusher_cluster"
                        value="{{ config('settings.pusher_cluster') }}">
                </div>

                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>
    </div>
</div>
