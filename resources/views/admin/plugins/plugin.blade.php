<div class="col-md-4">
    <div class="card plugin">
        <div class="card-content p-2">

            <a href="#">
                <div class="item-img text-center ">
                    <img class="img-fluid rounded-pill" src="{{ $plugin->image ?? '' }}" alt="img-placeholder">
                </div>
                <div class="my-2">
                    <h3>{{ $plugin->name }}</h3>
                </div>
            </a>

            <div class="mb-2">
                Plugin is a software component that adds a specific feature to an existing computer program
            </div>

            <div class="mb-4">
                <p class="item-company">
                    Author <a href="#" class="company-name">Appsaeed</a>
                </p>
            </div>

            <div class="item-options text-center">
                <div class="d-flex justify-content-between">
                    <button class="btn btn-primary">
                        <i data-feather="eye"></i> Preview
                    </button>
                    <button class="btn btn-success">
                        <i data-feather="plus-circle"></i> Install
                    </button>
                </div>
            </div>



        </div>
    </div>
</div>