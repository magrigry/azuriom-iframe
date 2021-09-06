@extends('admin.layouts.admin')

@section('title', 'Admin plugin home')

@section('content')
    <div class="card shadow mb-4">
        <form class="card-body" method="post">
            @csrf

            <div class="form-group mb-4">
                <label for="height">{{ trans('iframe.messages.height-label') }}</label>
                <input min="1" max="9999" type="number" class="form-control" id="height" name="height" value="{{ setting('iframe.height', 82) }}" required>
            </div>

            <div id="iframe-inputs" data-default-values="{{ $urls }}">

            </div>

            <button type="button" id="new-input" class="btn btn-primary">{{ trans('messages.actions.add') }}</button>
            <button type="submit" class="btn btn-success">{{ trans('messages.actions.save') }}</button>
        </form>
    </div>

    <script type="text/javascript">
        let template = `
            <div class="input-group mb-1">
                <div class="input-group-prepend">
                    <div class="input-group-text">{{ url('/iframe/i/') }}/</div>
                </div>
                <input placeholder="url" type="text" class="form-control" name="urls[]" value="%url_value%" required>
                <button maxlength="69" type="button" class="btn" onclick="iframeDeleteUrl(event)"><i class="fas fa-trash-alt"></i></button>
            </div>
            <div class="input-group mb-1">
                <input placeholder="Target" maxlength="254" type="text" class="form-control" name="targets[]" value="%target_value%" required>
            </div>
            <div class="input-group mb-4">
                <input placeholder="Page title" maxlength="29" type="text" class="form-control" name="titles[]" value="%title_value%" required>
            </div>`;

        try {
            let defaultValues = JSON.parse(document.getElementById('iframe-inputs').getAttribute('data-default-values'));

            Object.entries(defaultValues).forEach(([key, value]) => {
                let container = document.createElement("div");
                container.innerHTML = template.replace("%url_value%", key)
                                            .replace("%target_value%", value.target)
                                            .replace("%title_value%", value.title);
                document.getElementById('iframe-inputs').appendChild(container);
            })
        } catch (e) {
           console.log(e)
        }

        document.getElementById("new-input").addEventListener('click', function () {
            let container = document.createElement("div");
            container.innerHTML = template.replace("%url_value%", "")
                .replace("%target_value%", "")
                .replace("%title_value%", "");
            document.getElementById('iframe-inputs').appendChild(container);
        });

        iframeDeleteUrl = function (event) {
            if (!confirm("Confirmation")) {
                return;
            }

            console.log(event.target.parentNode.parentNode.parentNode.remove())
        }
    </script>
@endsection
