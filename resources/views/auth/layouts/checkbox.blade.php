<div class="row">
    <div class="col-xs-8">
        <div class="checkbox icheck">
            <label data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                <input type="checkbox"> I agree to the <a href="#">terms</a>
            </label>
            <br><br>
            <a href="{{ url('/login') }}" class="text-center">I already have a membership</a>
        </div>
    </div>
    <!-- /.col -->
    <div class="col-xs-4">
        <div id="collapseOne" aria-expanded="false" class="collapse">
            <button type="submit" class="btn btn-primary btn-block btn-flat">Register</button>
            <a href="/"><button type="button" class="btn btn-default btn-block btn-flat">Cansel</button></a>
        </div>
    </div>
    <!-- /.col -->
</div>