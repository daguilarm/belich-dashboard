<belich::fields :label="$item->label">
    <slot name="field">
        {{-- Set the autocomplete (visible) container --}}
        <input
            id="input-{{ md5($item->attribute) }}"
            list="list-{{ md5($item->attribute) }}"
            type="text"
            value="{{ $value ?? null }}"
            @if($item->responseArray)
                onchange="selectDatalist('{{ $item->attribute }}', '{{ md5($item->attribute) }}');"
            @elseif($item->responseUrl)
                onkeyup="requestAjax('{{ $item->responseUrl }}', '{{ md5($item->attribute) }}', '{{ $item->minChars }}', '{{ $item->addVars }}');"
                onchange="selectDatalist('{{ $item->attribute }}', '{{ md5($item->attribute) }}');"
            @endif
        >

        {{-- Hidden container with the value for storage --}}
        <input type="hidden" {!! $item->render !!} value="{{ $item->value }}">

        {{-- Create the data list --}}
        <datalist id="list-{{ md5($item->attribute) }}">
            @if($item->responseArray)
                @foreach($item->responseArray as $value => $label)
                    <option value="{{ $label }}" data-result="{{ $value }}">{{ $label }}</option>
                @endforeach
            @endif
        </datalist>

        {{-- Help container --}}
        @if($item->help)
            <div class="help-text">{{ $item->help }}</div>
        @endif

        {{-- Error container --}}
        <p id="error-{{ $item->id }}" class="validation-error"></p>

        {{-- Cast field --}}
        @include('belich::fields.cast')
    </slot>
</belich::fields>

@push('javascript')
    <script>
        {{-- Create the dataList --}}
        function selectDatalist(container, key) {
            if(document.getElementById('input-' + key)) {
                var val = document.getElementById('input-' + key).value;
                var opts = document.getElementById('list-' + key).childNodes;
                for(var i = 0; i < opts.length; i++) {
                    if(opts[i].value === val) {
                        // Update the value
                        document.getElementById(container).value = opts[i].getAttribute('data-result');
                        break;
                    }
                }
            }
        }

        function requestAjax(url, key, min, vars) {
            //Set default values
            const search = document.getElementById('input-' + key).value;
            const ajaxUrl = url + '/?search=' + search + (vars ? '&' + vars : '');
            var response;
            console.log(ajaxUrl);

            //Get ajax response
            if(search && search.length >= min) {
                const xhr = new XMLHttpRequest();
                xhr.open('GET', ajaxUrl , true);
                xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
                xhr.onreadystatechange = function() {
                    if(xhr.readyState == 4 && xhr.status == 200) {
                        var response = JSON.parse( xhr.responseText );
                        var container = document.getElementById('list-' + key);

                        // clear any previously loaded options in the datalist
                        container.innerHTML = "";

                        response.forEach(function(item) {
                            // Create a new <option> element.
                            var option = document.createElement('option');
                            option.value = item.label;
                            option.setAttribute('data-result', option.value);

                            // attach the option to the datalist element
                            container.appendChild(option);
                        });
                    }
                };
                xhr.send();
            }
        }
    </script>
@endpush
