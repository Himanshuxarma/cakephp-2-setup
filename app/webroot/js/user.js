"use strict";
var user_manager = function (options) {
    var self = this;
    this.page = 1;
    this.per_page = 10;
    this.pagination = false;
};

user_manager.prototype.processLocalStorage = function () {
    var self = this;
    self.pagination = false;
    self.fetch_user_data();
};

/**
 * Himanshu Sharma
 * Function to get list of the products and in stock products and out of stock products
 * @param {*} data 
 */
user_manager.prototype.fetch_user_data = function(data){
    var self = this;
    $.ajax({
        url: siteUrl+"/users",
        type: "POST",
        dataType: "json",
        data: {
            page: self.page,
            per_page: self.per_page,
        },
        beforeSend: function () {
            $("#user_table_data").html("");
            $("html, body").animate({ scrollTop: 0 }, 500);
        },
        success: function (response) {
            $("#user_table_data").html("");
            // console.log(response); return false;
            // alert(response.data.length);
            if (response.users.length > 0) {
                var cartHtml = self.setListing(response);
                // $("#total_vehicles").text(response.meta.total);
                jQuery("#user_table_data").html(cartHtml);
                if (self.pagination == false) {
                    $(function () {
                        $("#pagination").pagination({
                            items: response.meta.total,
                            itemsOnPage: self.per_page,
                            cssStyle: "dark-theme",
                            onPageClick: function (pageNumber) {
                                self.page = pageNumber;
                                data += "&page=" + self.page;
                                self.fetch_user_data(data);
                            },
                        });
                    });
                    self.pagination = true;
                }
            } else {
                self.pagination = false;
                $("#pagination").html("");
                $("#user_table_data").html("<h1>No Users Found</h1>");
            }
        },
        error: function (stat) {
            console.log(stat);
        },
    });
}

user_manager.prototype.setListing = function(data = null){
    console.log(data);
    let html = "";
    jQuery.each(data.users, function(index, item) {
        console.log(item.User);
        let role = '';
        if(item.User.is_admin == 1){
            role = 'Admin';
        } else {
            role = 'User';
        }
        html +=
            '<tr>\
                <td>'+item.User.id+'</td>\
                <td>'+item.User.first_name+'</td>\
                <td>'+item.User.last_name+'</td>\
                <td>'+item.User.contact_number+'</td>\
                <td><b>'+item.User.email+'</b></td>\
                <td>'+role+'</td>\
                <td>'+item.User.address+'</td>\
                <td>'+item.State.name+'</td>';
        if(data.meta.is_admin){
            html += '<td class="text-center">\
                        <div class="dropdown">\
                            <a href="javascript:void(0);" class="dropdown-toggle arrow-none card-drop" data-toggle="dropdown" aria-expanded="false">\
                                <i class="fa fa-ellipsis-v"></i>\
                            </a>\
                            <div class="dropdown-menu dropdown-menu-right">\
                                <a class="dropdown-item" href="'+siteUrl+'/users/edit/'+item.User.id+'">\
                                    <i class="fa fa-edit"></i>&nbsp;&nbsp;Edit\
                                </a>\
                                <a class="dropdown-item" href="'+siteUrl+'/users/delete/'+item.User.id+'" onclick="return confirm(\'Are you sure?\')">\
                                    <i class="fa fa-trash"></i>&nbsp;&nbsp;Delete\
                                </a>\
                            </div>\
                        </div>\
                    </td>';
        }
        html +='</tr>';
    });
    return html;
}
