<!-- card start -->
<div class="card home-page border-0 shadow rounded-lg mr-4" style="width: 20rem;">
    <div class="inner">
        <img src="{{ route('show_image',@$item->images) }}" class="card-img-top custom-card-height" alt="...">
        {{-- {{ route('show_image',@$item->images) }} --}}
    </div>
    <div class="card-body home-page">
        <h5 class="card-title home-page">
            @if(class_basename(@$item) === 'Event')
            <a href="{{route('page_evenement',@$item->slug)}}">{{@$item->title}}</a>
            @else
            <a href="{{route('page_annonce',@$item->slug)}}">{{@$item->title}}</a>
            @endif
        </h5>
        <h6 class="">
            <a class="card-subtitle mb-2 text-muted"
                href="{{route('user_profile',@$item->owned)}}">{{@$item->owned->prenom}}
                {{@$item->owned->name}}</a></h6>
        <div class="card-text card-descrip-styles">
            {{-- @php
            echo ($item->description);
            @endphp --}}
            Lorem ipsum dolor sit amet consectetur, adipisicing elit. Exercitationem beatae earum a eligendi ipsum ullam cupiditate culpa non dolorum eius.
        </div>
    </div>
</div>