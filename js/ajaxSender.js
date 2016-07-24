    var FormValidator = function(){};

    FormValidator.prototype = {
        isValid : function(){
            throw new Error("this method must be implemented by child Class");
        },
        highlightError: function()
        {
            var t = this;
            t.element.css("backgroundColor",'#FAC6C6');
            setTimeout(function(){t.element.css("backgroundColor",'');},3000);
    },
    getValidator : function(type,element)
    {
            switch (type)
            {
            // case 'number':
            // return new NumberFormValidator(element);
            // case 'required':
            // return new RequiredFormValidator(element);
            // // case 'regexp':
            // // return new RegExpFormValidator(element);
            // // case 'boolean':
            // // return new BooleanFormValidator(element);
            // // case 'length':
            // // return new LengthFormValidator(element);
            // // case 'compare':
            // return new CompareFormValidator(element);
            case 'email':
            return new EmailFormValidator(element);
            default:
            throw new Error('Validator: '+type+' does not exist');
        }
    },
    validate : function(elementsToValidate)
    {
        var t = this;
        for (var i =0;i<elementsToValidate.length;i++)
        {
            var validators = $(elementsToValidate[i]).data('validator').split(":");
            for (var j=0;j<validators.length;j++)
            {
                var validator = t.getValidator(validators[j],elementsToValidate[i]);
                if (!validator.isValid())
                {
                    validator.highlightError();
                    return false;
                }
            }
        }
        return true;
    }
};



var EmailFormValidator = function(el){
    this.element = $(el);
    this.emailRegexp = new RegExp("^[a-zA-Z0-9!#$%&\'*+\\/=?^_`{|}~-]+(?:\\.[a-zA-Z0-9!#$%&\'*+\\/=?^_`{|}~-]+)*@(?:[a-zA-Z0-9](?:[a-zA-Z0-9-]*[a-zA-Z0-9])?\\.)+[a-zA-Z0-9](?:[a-zA-Z0-9-]*[a-zA-Z0-9])?$");
};

EmailFormValidator.prototype = new FormValidator();

EmailFormValidator.prototype.isValid = function ()
{
    var value = this.element.val();
    return this.emailRegexp.test(value);
};


var AjaxFormSender = function(el,options)
{
    this.defaultOptions = {
        validation:true,
        validator: new FormValidator()
    };
    this.options = {};
    $.extend(this.options, this.defaultOptions, options);
    this.elements = el;
    this.currentElement = null;
    this.successList = {};
};

AjaxFormSender.prototype.init = function()
{
    var t = this;
    var o = this.options;
    if (this.elements.length>0) {
        this.elements.on('submit',function(e){
            e.preventDefault();
            t.currentElement = $(this);
            var isValid = true;
            if (o.validation) {
                var elementsToValidate = $(this).find('input, textarea').filter(function() { return typeof $(this).data("validator") !== "undefined"; });
                isValid = o.validator.validate(elementsToValidate);
            }
            if (isValid) {
                t.submitForm();
            }
        });
    }
};

AjaxFormSender.prototype.submitForm = function()
{
    var params = this.getAjaxParams();
    $.ajax(params);
};

AjaxFormSender.prototype.getAjaxParams = function()
{
    var t = this;
    var c = this.currentElement;
    var params = {};
    if (c) {
        params.type = c.attr('method') ?  c.attr('method'): 'POST';
        params.url = c.attr('action');
        params.data = c.serializeArray();
        params.dataType = c.data('type') ? c.data('type'): 'json';
        params.success = function (json)
        {
            t.proceedAjaxResponse(json);
        }
    }
    return params;
};

AjaxFormSender.prototype.getSuccessCallback = function(successId,data,run)
{
    if (typeof this.successList[successId] === 'function') {
        if (run) {
            this.successList[successId](data);
            return true;
        }
        return this.successList[successId];
    }
    return false;
};

AjaxFormSender.prototype.setSuccessCallback = function(successId, successFunction)
{
    if (typeof successId === 'object') {
        for (var i=0; i<successId.length; i++) {
            this.successList[successId[i]] = successFunction;
        }  
    } else {
        this.successList[successId] = successFunction;
    }
};

AjaxFormSender.prototype.proceedAjaxResponse = function(json)
{
    if (json.message) {
        var fieldMessage = $('.field-message-user');
        fieldMessage.html(json.message);

        // вот тут появляется поле
        fieldMessage.animate({opacity: 1, height: "100px"}, 3000, "easeOutElastic");
        // а тут убирается
        fieldMessage.animate({opacity: 0, height: "0px"}, 10000, "easeOutElastic");
    }

    var t = this.currentElement;
    t.trigger('reset');
    if (json.status == "ok") {
        this.getSuccessCallback(t.attr('name'), json.data, true);
    }

};








// ajax for editor

var AjaxEditor = function(el,options)
{
    this.elements = el;
    this.currentElement = null;
    this.successList = {};
};

AjaxEditor.prototype.init = function()
{
    var t = this;
    if (this.elements.length > 0) {
        this.elements.on('click',function(e){
            e.preventDefault();
            t.currentElement = $(this);
            t.sendData();
        });
    }
};

AjaxEditor.prototype.sendData = function()
{
    var params = this.getAjaxParams();
    $.ajax(params);
};

AjaxEditor.prototype.getAjaxParams = function()
{
    var t = this;
    var c = this.currentElement;
    var params = {};
    if (c) {
        params.type = 'POST';
        params.url = c.data('action');
        this.nameEditor = c.data('editor');
        var editor = $("#"+this.nameEditor);
        var data = null;
        if (editor) {
           data = {data: editor.html()};
       } else {
        throw new Error('Editor: '+this.nameEditor+' does not exist');
    }
    params.data = data;
    params.dataType = 'json';
    params.success = function (json)
    {
        t.proceedAjaxResponse(json);
    }
}
return params;
};

AjaxEditor.prototype.getSuccessCallback = function(successId,data,run)
{
    if (typeof this.successList[successId] === 'function') {
        if (run) {
            this.successList[successId](data, this.nameEditor);
            return true;
        }
        return this.successList[successId];
    }
    return false;
};

AjaxEditor.prototype.setSuccessCallback = function(successId, successFunction)
{
    this.successList[successId] = successFunction;
};

AjaxEditor.prototype.proceedAjaxResponse = function(json)
{
    if (json.message) {
        var fieldMessage = $('.field-message-user');
        fieldMessage.html(json.message);

        // вот тут появляется поле
        fieldMessage.animate({opacity: 1, height: "100px"}, 3000, "easeOutElastic");
        // а тут убирается
        fieldMessage.animate({opacity: 0, height: "0px"}, 10000, "easeOutElastic");
    }

    var t = this.currentElement;
    this.getSuccessCallback(t.data('success'), json.data, true);

};


// data-editor=""
// data-action=""
// class ajax-edit
// data-success=""