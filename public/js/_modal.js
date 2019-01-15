class _modal {
    constructor(options) {
        let optionsDefault = {
            title            : "Modal",
            modalDomClass    : 'blc-modal-dom-class',
            modalParentClass : 'container',
            body             : '<p>this is modal test</p>',
            buttonConfirms   : {
                show     : false,
                label    : "Confirm",
                domClass : 'js-apply'
            },
            buttonClose      : {
                label      : 'Close',
                btnDefault : 'btn-default',
                domClass   : 'js-close'
            },
            style            : {
                width : '800px'
            },
            select2          : false,
            textEditor       : false,
        };

        let param   = Object.assign({}, optionsDefault, options);
        this.config = {
            configJquery : {
                parentClass     : $(`.${param.modalParentClass}`),
                modalClass      : $(`.${param.modalDomClass}`),
                modalCloseClass : $(`.${param.buttonClose.domClass}`),
            },
            domClass     : {
                close : `.${param.buttonClose.domClass}`,
                modal : `.${param.modalDomClass}`
            }
        };
        this.param  = param;
    }

    open() {
        let confirmButton = this.generateConfirmButton(this.param.buttonConfirms.show);
        let style         = `style="width:${this.param.style.width}"`;
        let template      = `<div class="modal fade ${this.param.modalDomClass}" role="dialog">
                                <div class="modal-dialog">
                                    <div class="modal-content" ${style}>
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title blc-title"> ${this.param.title} </h4>
                                        </div>
                                        <div class="modal-body">
                                            ${this.param.body}
                                        </div>
                                        <div class="modal-footer">
                                            ${confirmButton}
                                            <button type="button" class="btn ${this.param.buttonClose.btnDefault} ${this.param.buttonClose.domClass} ">${this.param.buttonClose.label}</button>
                                        </div>
                                    </div>
                                </div>
                            </div>`;

        this.config.configJquery.parentClass.append(template);
        this.config.configJquery.parentClass.find(this.config.domClass.modal).modal({
            backdrop : 'static'
        });

        this.listener();
    }

    close() {
        this.config.configJquery.parentClass.find(this.config.domClass.modal).find(this.config.domClass.close).trigger('click');
    }

    generateConfirmButton(flg) {
        return flg ? `<button type="button" class="btn btn-primary ${this.param.buttonConfirms.domClass}">${this.param.buttonConfirms.label}</button>` : '';
    }

    changeBody(body) {
        this.config.configJquery.parentClass.find(this.config.domClass.modal).find('.modal-body').html(body);
    }

    listener() {
        let self = this;

        self.config.configJquery.parentClass.find(self.config.domClass.modal).on('click', self.config.domClass.close, function () {
            self.config.configJquery.parentClass.find(self.config.domClass.modal).modal('hide');
        });

        self.config.configJquery.parentClass.find(self.config.domClass.modal).on('hidden.bs.modal', function () {
            $(this).remove();
        });
    }
}