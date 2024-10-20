import './bootstrap';

function myPlugin(editor) {
    // Use the API: https://grapesjs.com/docs/api/
    editor.Blocks.add('payment-link', {
        label: 'Simple block',
        content: '<a href="/boc/payment" class="my-block">Payment</a>',
    });
}
