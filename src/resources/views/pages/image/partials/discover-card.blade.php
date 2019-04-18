<div class="card">
    <div class="card-image">
        <a href="{{ route('image', $image) }}">
            <img src="{{ $image->getUrl('grid') }}">
        </a>
    </div>
    <div class="card-content grey darken-3">
        <p class="image-description white-text">
            <i class="fa fa-eye"></i>
        </p>
    </div>
</div>