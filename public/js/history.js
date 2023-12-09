
class Histoty {

    viewPaymentHistory(data) {

        $("#history").dxDataGrid({
            dataSource: data,
            keyExpr: "id",
            allowColumnResizing: true,
            columnAutoWidth: true,
            loadPanel: {
                enabled: true
            },
            editing: {
                allowDeleting() {
                    return true;
                },
                useIcons: true,
            },
            onRowRemoving: function (e) {
                var deferred = $.Deferred();
                $.ajax({
                    url: `/history/delete/${e.key}`,
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (result) {
                        if (result.success == false) {
                            deferred.reject(result.message);
                        } else {
                            deferred.resolve(false);
                        }
                    },
                    error: function (result) {
                        deferred.reject(result.responseText);
                    }

                });
                e.cancel = deferred.promise();
            }
            ,
            columns: [
                {
                    dataField: "id",
                    dataType: 'number'
                },
                {
                    dataField: "created_at",
                    dataType: 'datetime',
                    caption: 'Date',

                },
                {
                    dataField: "last4",
                    caption: 'Card Number',
                    dataType: 'string',
                    cellTemplate(container, options) {
                        var card = options.data.last4;
                        container.append($('<span>').text('XXXX-XXXX-XXXX-' + card));
                    }
                },
                {
                    dataField: "exp_month",
                    dataType: 'number',
                    caption: 'Expiry Month',
                },
                {
                    dataField: "exp_year",
                    dataType: 'number',
                    caption: 'Expiry Year',
                },
                {
                    dataField: "token_id",
                    dataType: 'string'
                },
                {
                    dataField: "card_holder",
                    dataType: 'string'
                },
                {
                    dataField: "amount",
                    dataType: 'number'
                },
                {
                    dataField: "status",
                    dataType: 'string',
                    cellTemplate(container, options) {
                        var status = options.data.status;
                        container.append($('<span>').text((status == '0' ? 'fail' : 'success')));
                    }
                },
                {
                    dataField: "message",
                    dataType: 'string'
                },
            ],
            onContentReady(){
                $("#history table").addClass('table-hover');
            }
        });

    }
}

$(document).ready(function () {
    var history = new Histoty();
    history.viewPaymentHistory(data);
});