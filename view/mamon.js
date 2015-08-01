/**
 * Represents a MamoClient.
 * @constructor
 */
var MamonClient = function () {

    /**
     * Host
     *
     * @type {String}
     */
    var host = 'http://localhost:8090/api.php/';

    /**
     * Mamon root element
     *
     * @type {jQuery} DOM element node
     */
    var DOMmamon = $('<div/>').attr({'id': 'mamon'}).appendTo('body');

    /**
     * http wrapper
     *
     * @param  {string} url
     * @return {Promise}
     */
    var http = function(url) {

        ajaxOptions = {
            url: url
        }

        return $.ajax(ajaxOptions);
    };

    /**
     * Call to the answer url
     *
     * @param  {string} data
     * @return {Promise}
     */
    var sendSolution = function(data)
    {

        var reduced = data.values.reduce(function(left, right) {
            return left+right;
        });

        return http(host+'answer/?token='+data.token+'&sum='+reduced);
    };

    /**
     * call to the question url
     *
     * @return {[type]} [description]
     */
    var gotQuestion = function () {
        return http(host+'question/');
    };

    /**
     * prints the answer
     *
     * @param  {string} data
     * @return {void}
     */
    var outputSuccess = function (data) {

        $('<p/>').html(data.answer).appendTo(DOMmamon);
    };

    /**
     * prints the error
     *
     * @return {void}
     */
    var outputError = function() {

        $('<p/>')
        .attr({'id': 'error'})
        .html('Unable to retrieve the question!')
        .appendTo(DOMmamon);
    };

    /**
     * Public api to init the calls
     *
     * @return {void}
     */
    var feed = function () {
        $.when(gotQuestion()).then(sendSolution).done(outputSuccess).fail(outputError);
    };


    return {
        feed: feed
    };
};
