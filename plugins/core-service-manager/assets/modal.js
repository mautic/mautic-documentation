/*
 * The MIT License (MIT)
 *
 * Copyright (c) 2018-2020 TwelveTone LLC
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 */
/**
 * A very simple class for displaying modal dialogs.
 * Dialogs include alert, confirm, and custom.
 */
class Modal {
    static confirm(message, okCallback) {
        const modalTemplate = `
<div class="modal">
    <div class="modal-content">
        <div class="modal-header">
        </div>
        <div class="modal-body">
            <div class="modal-message">${message}</div>
        </div>
        <div class="modal-footer">
        </div>  
        <div class="modal-actions">
            <button class="modal-cancel button">Cancel</button>
            <button class="modal-ok button">OK</button>
        </div>
    </div>
</div>
`;
        const $modal = $(modalTemplate).appendTo('body');
        const ok = $modal.find('.modal-ok');
        const cancel = $modal.find('.modal-cancel');

        ok.on('click', () => {
            $modal.hide();
            $modal.remove();
            okCallback();
        });

        cancel.on('click', () => {
            $modal.hide();
            $modal.remove();
        });

        $modal.show();

        return {
            modal: $modal,
            close: (yes) => {
                if (yes) {
                    ok.click();
                } else {
                    cancel.click();
                }
            }
        }
    }

    static alert(message, okCallback) {
        const modalTemplate = `
<div class="modal">
    <div class="modal-content">
        <div class="modal-header">
        </div>
        <div class="modal-body">
            <div class="modal-message">${message}</div>
        </div>
        <div class="modal-footer">
        </div>  
        <div class="modal-actions">
            <button class="modal-ok button">OK</button>
        </div>
    </div>
</div>
`;
        const $modal = $(modalTemplate).appendTo('body');
        const ok = $modal.find('.modal-ok');

        ok.on('click', () => {
            $modal.hide();
            $modal.remove();
            if (okCallback) {
                okCallback();
            }
        });

        $modal.show();

        return {
            modal: $modal,
            close: () => {
                ok.click();
            }
        }
    }
}
