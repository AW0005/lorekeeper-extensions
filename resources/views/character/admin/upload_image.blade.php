@extends('character.layout')

@section('profile-title') {{ $character->fullName }} - Upload New Image @endsection

@section('profile-content')
{!! breadcrumbs(['Masterlist' => 'masterlist', $character->fullName => $character->url]) !!}

@include('character._header', ['character' => $character])

<p>This will add a new form to the character. If the character is marked as visible, the owner of the character will be notified of the upload.</p>

{!! Form::open(['url' => 'admin/character/'.$character->slug.'/image', 'files' => true]) !!}

<h3>Validity</h3>

<div class="form-group">
    {!! Form::checkbox('set_active', 1, 0, ['class' => 'form-check-input', 'data-toggle' => 'toggle']) !!}
    {!! Form::label('set_active', 'Set Active Image', ['class' => 'form-check-label ml-3']) !!} {!! add_help('If this is turned on, the image will be set as the active image for the character.') !!}
</div>
<div class="form-group">
    {!! Form::checkbox('is_valid', 1, 1, ['class' => 'form-check-input', 'data-toggle' => 'toggle']) !!}
    {!! Form::label('is_valid', 'Is Valid', ['class' => 'form-check-label ml-3']) !!} {!! add_help('If this is turned off, the image will still be visible, but displayed with a note that the image is not a valid reference.') !!}
</div>

<h3>Image Upload</h3>

<div class="form-group">
    {!! Form::label('Character Image') !!} {!! add_help('This is the full masterlist image.') !!}
    <div>{!! Form::file('image', ['id' => 'mainImage']) !!}</div>
</div>
<div class="form-group">
    {!! Form::label('Designer(s)') !!}
    <div id="designerList">
        <div class="mb-2 d-flex">
            {!! Form::select('designer_id[]', $users, null, ['class'=> 'form-control mr-2 selectize', 'placeholder' => 'Select a Designer']) !!}
            {!! Form::text('designer_url[]', null, ['class' => 'form-control mr-2', 'placeholder' => 'Designer URL']) !!}
            @if(Config::get('lorekeeper.extensions.extra_image_credits'))
                {!! Form::text('designer_type[]', null, ['class' => 'form-control mr-2', 'placeholder' => 'Other Info']) !!}
            @endif
            <a href="#" class="add-designer btn btn-link" data-toggle="tooltip" title="Add another designer">+</a>
        </div>
    </div>
    <div class="designer-row hide mb-2">
        {!! Form::select('designer_id[]', $users, null, ['class'=> 'form-control mr-2 designer-select', 'placeholder' => 'Select a Designer']) !!}
        {!! Form::text('designer_url[]', null, ['class' => 'form-control mr-2', 'placeholder' => 'Designer URL']) !!}
        @if(Config::get('lorekeeper.extensions.extra_image_credits'))
            {!! Form::text('designer_type[]', null, ['class' => 'form-control mr-2', 'placeholder' => 'Other Info']) !!}
        @endif
        <a href="#" class="add-designer btn btn-link" data-toggle="tooltip" title="Add another designer">+</a>
    </div>
</div>
<div class="form-group">
    {!! Form::label('Artist(s)') !!}
    <div id="artistList">
        <div class="mb-2 d-flex">
            {!! Form::select('artist_id[]', $users, null, ['class'=> 'form-control mr-2 selectize', 'placeholder' => 'Select an Artist']) !!}
            {!! Form::text('artist_url[]', null, ['class' => 'form-control mr-2', 'placeholder' => 'Artist URL']) !!}
            @if(Config::get('lorekeeper.extensions.extra_image_credits'))
                {!! Form::text('artist_type[]', null, ['class' => 'form-control mr-2', 'placeholder' => 'Other Info']) !!}
            @endif
            <a href="#" class="add-artist btn btn-link" data-toggle="tooltip" title="Add another artist">+</a>
        </div>
    </div>
    <div class="artist-row hide mb-2">
        {!! Form::select('artist_id[]', $users, null, ['class'=> 'form-control mr-2 artist-select', 'placeholder' => 'Select an Artist']) !!}
        {!! Form::text('artist_url[]', null, ['class' => 'form-control mr-2', 'placeholder' => 'Artist URL']) !!}
        @if(Config::get('lorekeeper.extensions.extra_image_credits'))
            {!! Form::text('artist_type[]', null, ['class' => 'form-control mr-2', 'placeholder' => 'Other Info']) !!}
        @endif
        <a href="#" class="add-artist btn btn-link mb-2" data-toggle="tooltip" title="Add another artist">+</a>
    </div>
</div>

{{-- <div class="form-group">
    {!! Form::label('Image Notes (Optional)') !!} {!! add_help('This section is for making additional notes about the image.') !!}
    {!! Form::textarea('image_description', old('image_description'), ['class' => 'form-control wysiwyg']) !!}
</div> --}}

<h3>
    {{-- <div class="float-right"><a href="#" class="btn btn-info btn-sm" data-toggle="tooltip" title="This will fill the below fields with the same data as the character's current image. Note that this will overwrite any changes made below.">Fill Data</a></div> --}}
Traits
</h3>

<div class="form-group">
    {!! Form::label('Species') !!}
    {!! Form::select('species_id', $specieses, old('species_id') ? : $character->image->species_id, ['class' => 'form-control', 'id' => 'species']) !!}
</div>

<div class="form-group" id="subtypes">
    {!! Form::label('Subtype (Optional)') !!}
    {!! Form::select('subtype_id', $subtypes, old('subtype_id') ? : $character->image->subtype_id, ['class' => 'form-control', 'id' => 'subtype']) !!}
</div>

<div class="form-group">
    {!! Form::label('Character Rarity') !!}
    {!! Form::select('rarity_id', $rarities, old('rarity_id') ? : $character->image->rarity_id, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('Traits') !!}
    <div id="featureList">
    </div>
    <div><a href="#" class="btn btn-primary" id="add-feature">Add Trait</a></div>
    <div class="feature-row hide mb-2">
        {!! Form::select('feature_id[]', $features, null, ['class' => 'form-control mr-2 feature-select', 'placeholder' => 'Select Trait']) !!}
        {!! Form::text('feature_data[]', null, ['class' => 'form-control mr-2', 'placeholder' => 'Extra Info (Optional)']) !!}
        <a href="#" class="remove-feature btn btn-danger mb-2"><i class="fas fa-times"></i></a>
    </div>
</div>

<div class="text-right">
    {!! Form::submit('Create Image', ['class' => 'btn btn-primary']) !!}
</div>
{!! Form::close() !!}

@endsection

@section('scripts')
@parent
<script>
$( document ).ready(function() {
    const features = <?php echo json_encode($features) ?>;

        const getFeatureOptions = (species) => {
            const arry = [];
            const groups = [];
            for(const [key, cat] of Object.entries(features)) {
                const catObj = [];
                groups.push(key);
                for(feat in cat) {
                    if((!species || cat[feat].species_id === species)) {
                        arry.push({text: cat[feat].simpleName, value: cat[feat].id, optgroup: key });
                    }
                }
            }

            return {features: arry, groups};
        }



    // Cropper ////////////////////////////////////////////////////////////////////////////////////

    var $useCropper = $('#useCropper');
    var $thumbnailCrop = $('#thumbnailCrop');
    var $thumbnailUpload = $('#thumbnailUpload');

    var useCropper = $useCropper.is(':checked');

    updateCropper();

    $useCropper.on('change', function(e) {
        useCropper = $useCropper.is(':checked');

        updateCropper();
    });

    function updateCropper() {
        if(useCropper) {
            $thumbnailUpload.addClass('hide');
            $thumbnailCrop.removeClass('hide');
        }
        else {
            $thumbnailCrop.addClass('hide');
            $thumbnailUpload.removeClass('hide');
        }
    }

    // Designers and artists //////////////////////////////////////////////////////////////////////

    $('.add-designer').on('click', function(e) {
        e.preventDefault();
        addDesignerRow($(this));
    });
    function addDesignerRow($trigger) {
        var $clone = $('.designer-row').clone();
        $('#designerList').append($clone);
        $clone.removeClass('hide designer-row');
        $clone.addClass('d-flex');
        $clone.find('.add-designer').on('click', function(e) {
            e.preventDefault();
            addDesignerRow($(this));
        })
        $clone.find('.designer-select').selectize();
        $trigger.css({ visibility: 'hidden' });
    }

    $('.add-artist').on('click', function(e) {
        e.preventDefault();
        addArtistRow($(this));
    });
    function addArtistRow($trigger) {
        var $clone = $('.artist-row').clone();
        $('#artistList').append($clone);
        $clone.removeClass('hide artist-row');
        $clone.addClass('d-flex');
        $clone.find('.add-artist').on('click', function(e) {
            e.preventDefault();
            addArtistRow($(this));
        })
        $clone.find('.artist-select').selectize();
        $trigger.css({ visibility: 'hidden' });
    }

    // Traits /////////////////////////////////////////////////////////////////////////////////////

    $('#add-feature').on('click', function(e) {
        e.preventDefault();
        addFeatureRow();
    });
    $('.remove-feature').on('click', function(e) {
        e.preventDefault();
        removeFeatureRow($(this));
    })
    function addFeatureRow() {
        var $clone = $('.feature-row').clone();
        $('#featureList').append($clone);
        $clone.removeClass('hide feature-row');
        $clone.addClass('d-flex');
        $clone.find('.remove-feature').on('click', function(e) {
            e.preventDefault();
            removeFeatureRow($(this));
        })
        const selects = $clone.find('.feature-select');

        selects.selectize({
            render: {
                item: featureSelectedRender,
                option: (opt) => `<div class="option" data-selectable="" data-value="${opt['value']}">${opt['text']}</div>`
            }
        });

        selects.each(select => {
            const selectize = selects[select].selectize;
            if(selectize) {
                const {features, groups} = getFeatureOptions(parseInt($('#species').val(), 10));

                const selected = selectize.items[0];
                selectize.clear()
                selectize.clearOptions();
                groups.forEach(group => selectize.addOptionGroup(group, {label: group}));
                selectize.addOption(features);
                selectize.refreshOptions(false);
                selectize.addItem(selected);
            }
        });
    }
    function removeFeatureRow($trigger) {
        $trigger.parent().remove();
    }
    function featureSelectedRender(item, escape) {
        return '<div><span>' + item["text"].trim() + '<span class="subdued"> [' + escape(item["optgroup"].trim()) + ']</span>' + '</span></div>';
    }

    // Croppie ////////////////////////////////////////////////////////////////////////////////////

    var thumbnailWidth = {{ Config::get('lorekeeper.settings.masterlist_thumbnails.width') }};
    var thumbnailHeight = {{ Config::get('lorekeeper.settings.masterlist_thumbnails.height') }};
    var $cropper = $('#cropper');
    var c = null;
    var $x0 = $('#cropX0');
    var $y0 = $('#cropY0');
    var $x1 = $('#cropX1');
    var $y1 = $('#cropY1');
    var zoom = 0;

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $cropper.attr('src', e.target.result);
                c = new Croppie($cropper[0], {
                    viewport: {
                        width: thumbnailWidth,
                        height: thumbnailHeight
                    },
                    boundary: { width: thumbnailWidth + 100, height: thumbnailHeight + 100 },
                    update: function() {
                        updateCropValues();
                    }
                });
                updateCropValues();
                $('#cropSelect').addClass('hide');
                $cropper.removeClass('hide');
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#mainImage").change(function() {
        readURL(this);
    });

    function updateCropValues() {
        var values = c.get();
        $x0.val(values.points[0]);
        $y0.val(values.points[1]);
        $x1.val(values.points[2]);
        $y1.val(values.points[3]);
    }


});



$( "#species" ).change(function() {
  var species = $('#species').val();
  var id = '<?php echo($character->image->id); ?>';
  $.ajax({
    type: "GET", url: "{{ url('admin/character/image/subtype') }}?species="+species+"&id="+id, dataType: "text"
  }).done(function (res) { $("#subtypes").html(res); }).fail(function (jqXHR, textStatus, errorThrown) { alert("AJAX call failed: " + textStatus + ", " + errorThrown); });

});

</script>
@endsection
