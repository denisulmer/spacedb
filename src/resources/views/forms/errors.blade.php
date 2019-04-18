@if ($errors->count())
    <div class="row">
        <div class="col s12">
            <div class="card-panel red z-depth-2 darken-2 hoverable" style="padding: 15px; border-radius: 10px;">
                <p class="grey-text text-lighten-2">
                    {{ listErrors($errors->all()) }}
                </p>
            </div>
        </div>
    </div>
@endif