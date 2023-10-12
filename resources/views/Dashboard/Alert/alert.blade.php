
@if(session('message'))

    <script>
        let returnData = {{ \Illuminate\Support\Js::from(session('message')) }}

        Swal.fire({
            html: '<div class="mt-3">' +
                @switch(session('message')['icon'])
                    @case('success')
                    '<lord-icon src="https://cdn.lordicon.com/lupuorrc.json" trigger="loop" colors="primary:#0ab39c,secondary:#405189" style="width:120px;height:120px">' +
                    @break
                    @case('error')
                        '<lord-icon src="https://cdn.lordicon.com/tdrtiskw.json" trigger="loop" colors="primary:#f06548,secondary:#f7b84b" style="width:120px;height:120px">' +
                    @break
                    @case('question')
                        '<lord-icon src="https://cdn.lordicon.com/tdrtiskw.json" trigger="loop" colors="primary:#f06548,secondary:#f7b84b" style="width:120px;height:120px">' +
                    @break
                @endswitch
                '</lord-icon>' +
                '<div class="mt-4 pt-2 fs-15">' +
                `<h4>${returnData.icon}</h4>` +
                `<p class="text-muted mx-4 mb-0">${returnData.text}</p>` +
                '</div>' +
                '</div>',
            showCancelButton: !0,
            showConfirmButton: !1,
            @switch(session('message')['icon'])
                @case('success') cancelButtonClass: "btn btn-primary w-xs mb-1", @break
                @case('error')  cancelButtonClass: "btn btn-danger w-xs mb-1", @break
            @endswitch
            cancelButtonText: "Back",
            buttonsStyling: !1,
            showCloseButton: !0,
            background: "#fff url({{ asset('assets/images/chat-bg-pattern.png') }})",
        });
    </script>

@endif
