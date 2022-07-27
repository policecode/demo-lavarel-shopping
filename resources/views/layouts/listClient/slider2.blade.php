@if (loadSlider()->count() > 0)
    <section class="sub-bnr" data-stellar-background-ratio="0.5" style="background-image:url({{loadSlider()[0]->image_path}});">
        <div class="position-center-center">
            <div class="container">
                <h4>{{loadSlider()[0]->name}}</h4>
                <p>{{loadSlider()[0]->description}}</p>
            </div>
        </div>
    </section>
@endif
