<x-modal id="tools_message_modal" title="&nbsp;" size="sm">
    <p class="modal-message"></p>
</x-modal>

<x-modal id="tools_question_modal" title="&nbsp;" size="sm">
    <p class="modal-message"></p>

    <x-slot name="footer">
        <button type="button" class="btn btn-secondary modal-abort-button" data-dismiss="modal">{{ucwords(__('def-components::modals.abort'))}}</button>
        <button type="button" class="btn modal-ok-button" data-dismiss="modal">{{ucwords(__('def-components::modals.continue'))}}</button>
    </x-slot>
</x-modal>

<script type="text/javascript" src="{{ asset('js/defstudio/components/tools.js') }}" defer></script>
