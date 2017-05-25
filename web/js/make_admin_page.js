/**
 * Created by bohdan on 24.04.2017.
 */
var $s = nbInit({});

function updateData(model,id,key,value){
    $.getJSON("admin/update",{model: model, id: id, key: key, value: value}, function(data){
    });
}

// function add_list() {
//
//     var mod = document.getElementById('models').value;
//     // alert(mod);
//          readModelDataAdd(mod);


//}

document.addEventListener("DOMContentLoaded",function(){
    $.getJSON("admin/models", function(models){
        $s.models = models;
        for (var key in models){
            readModelData(key);
            break;
        }
        document.getElementById('models').onchange = function(){
            readModelData(this.value);
        }
    });
});

function readModelData(model){
    $.getJSON("admin/data",{model: model}, function(data){
        $s.dataHead = [data[0]];
        var ediItem, ediKey, ediCell;
        data[1].forEach(function(item){
            for (var key in item){
                item[key] = {
                    ondblclick: function(){
                        if ($s.ediInput){
                            ediItem[ediKey] = $s.ediInput;
                            ediCell.innerHTML = $s.ediInput;
                            updateData(model, ediCell.parentElement.children[0].innerText, ediKey, ediItem[ediKey]);
                            ediCell = null;
                            ediItem = null;
                            ediKey  = null;
                        } else {
                            var text = this.innerHTML;
                            this.innerHTML = "<input id='ediInput'/>";
                            $s.ediInput    = text;
                            ediItem = this.parentElement.nbData;
                            ediCell = this;
                            var i = 0;
                            for (var key in ediItem){
                                if (this.parentElement.children[i] == this){
                                    ediKey = key;
                                    break;
                                }
                                i++;
                            }
                        }
                    },
                    innerText: item[key]
                };
            }
            item.__editColumn = {onclick: function(){
                if (confirm("Are you sure to delete?")){
                    var id = this.parentElement.children[0].innerText;
                    $.getJSON("admin/delete",{model: model, id: id}, function(data){
                        readModelData(model);
                    });
                }
            },
                innerHTML: "<b>X</b>"};
        });
        $s.data = data[1];
    })
}

function readModelDataAdd(model){
    $.getJSON("admin/data-add",{model: model}, function(data){
        $s.dataHead = [data[0]];
        var ediItem, ediKey, ediCell;
        data[1].forEach(function(item){
            for (var key in item){
                item[key] = {
                    ondblclick: function(){
                        if ($s.ediInput){
                            ediItem[ediKey] = $s.ediInput;
                            ediCell.innerHTML = $s.ediInput;
                            updateData(model, ediCell.parentElement.children[0].innerText, ediKey, ediItem[ediKey]);
                            ediCell = null;
                            ediItem = null;
                            ediKey  = null;
                        } else {
                            var text = this.innerHTML;
                            this.innerHTML = "<input id='ediInput'/>";
                            $s.ediInput    = text;
                            ediItem = this.parentElement.nbData;
                            ediCell = this;
                            var i = 0;
                            for (var key in ediItem){
                                if (this.parentElement.children[i] == this){
                                    ediKey = key;
                                    break;
                                }
                                i++;
                            }
                        }
                    },
                    innerText: item[key]
                };
            }
            item.__editColumn = {onclick: function(){
                if (confirm("Are you sure to delete?")){
                    var id = this.parentElement.children[0].innerText;
                    alert(id);
                    $.getJSON("admin/delete",{model: model, id: id}, function(data){
                        readModelData(model);
                    });
                }
            },
                innerHTML: "<b>X</b>"};
        });
        $s.data = data[1];
    })
}