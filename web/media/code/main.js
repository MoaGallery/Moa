(window["webpackJsonp"] = window["webpackJsonp"] || []).push([["main"],{

/***/ "./node_modules/raw-loader/index.js!./src/app/app.component.html":
/*!**************************************************************!*\
  !*** ./node_modules/raw-loader!./src/app/app.component.html ***!
  \**************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = "<breadcrumb></breadcrumb>\n\n<router-outlet></router-outlet>"

/***/ }),

/***/ "./node_modules/raw-loader/index.js!./src/app/breadcrumb/breadcrumb.component.html":
/*!********************************************************************************!*\
  !*** ./node_modules/raw-loader!./src/app/breadcrumb/breadcrumb.component.html ***!
  \********************************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = "<ol class=\"breadcrumb\">\n\t<li><a [routerLink]=\"['/']\">Home</a></li>\n\n\t<li *ngFor=\"let crumb of crumbs; let last = last\">\n\t  <a *ngIf=\"!last\"  [routerLink]=\"[getLink(crumb.id)]\">{{crumb.name}}</a>\n\t  <span *ngIf=\"last\">{{crumb.name}}</span>\n\t</li>\n</ol>\n"

/***/ }),

/***/ "./node_modules/raw-loader/index.js!./src/app/gallery/gallery-edit/gallery-edit.component.html":
/*!********************************************************************************************!*\
  !*** ./node_modules/raw-loader!./src/app/gallery/gallery-edit/gallery-edit.component.html ***!
  \********************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = "<div class=\"modal fade\" id=\"edit-modal\">\n\t<div class=\"modal-dialog\">\n\t\t<div class=\"modal-content\">\n\t\t\t<div class=\"modal-header\">\n\t\t\t\t<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>\n\t\t\t\t<h4 class=\"modal-title\">Edit gallery</h4>\n\t\t\t</div>\n\t\t\t<form action=\"/gallery/{{gallery.id}}\" method=\"post\" class=\"form-horizontal\">\n\t\t\t\t<div class=\"modal-body\">\n\n\t\t\t\t\t<div class=\"form-group\">\n\t\t\t\t\t\t<label for=\"inputGalleryName\" class=\"col-sm-2 control-label\">Name</label>\n\t\t\t\t\t\t<div class=\"col-sm-10\">\n\t\t\t\t\t\t\t<input type=\"text\" class=\"form-control\" name=\"inputGalleryName\" id=\"inputGalleryName\" placeholder=\"Edit...\" [(ngModel)]=\"name\">\n\t\t\t\t\t\t</div>\n\t\t\t\t\t</div>\n\n\t\t\t\t\t<div class=\"form-group\">\n\t\t\t\t\t\t<label for=\"inputGalleryDescription\" class=\"col-sm-2 control-label\">Description</label>\n\t\t\t\t\t\t<div class=\"col-sm-10\">\n\t\t\t\t\t\t\t<textarea class=\"form-control\" name=\"inputGalleryDescription\" id=\"inputGalleryDescription\" placeholder=\"Edit...\" [(ngModel)]=\"description\"></textarea>\n\t\t\t\t\t\t</div>\n\t\t\t\t\t</div>\n\n\t\t\t\t\t<div class=\"form-group\">\n\t\t\t\t\t\t<label for=\"inputGalleryParent\" class=\"col-sm-2 control-label\">Parent</label>\n\t\t\t\t\t\t<div class=\"col-sm-10\">\n\t\t\t\t\t\t\t<select class=\"form-control\" name=\"inputGalleryParent\" id=\"inputGalleryParent\" style=\"width: 100%\">\n\t\t\t\t\t\t\t\t<option value=\"{{parent_gallery.id}}\" selected=\"selected\">{{parent_gallery.name}}</option>\n\t\t\t\t\t\t\t</select>\n\t\t\t\t\t\t</div>\n\t\t\t\t\t</div>\n\n\t\t\t\t\t<div class=\"form-group\">\n\t\t\t\t\t\t<label for=\"inputGalleryTags\" class=\"col-sm-2 control-label\">Tags</label>\n\t\t\t\t\t\t<div class=\"col-sm-10\">\n\t\t\t\t\t\t\t<select class=\"form-control\" name=\"inputGalleryTags[]\" id=\"inputGalleryTags\" style=\"width: 100%\" multiple>\n\t\t\t\t\t\t\t\t<option *ngFor=\"let tag of tagList\" value=\"{{tag.id}}\" selected=\"selected\">{{tag.name}}</option>\n\t\t\t\t\t\t\t</select>\n\t\t\t\t\t\t</div>\n\t\t\t\t\t</div>\n\n\t\t\t\t\t<div class=\"form-group\">\n\t\t\t\t\t\t<div class=\"checkbox\">\n\t\t\t\t\t\t\t<div class=\"col-sm-2\"></div>\n\t\t\t\t\t\t\t<div class=\"col-sm-10\">\n\t\t\t\t\t\t\t\t<input type=\"checkbox\" name=\"inputGalleryCombinedView\" id=\"inputGalleryCombinedView\" [(ngModel)]=\"showImages\">\n\t\t\t\t\t\t\t\t<label for=\"inputGalleryCombinedView\" class=\"control-label\">Show images when there are subgalleries</label>\n\t\t\t\t\t\t\t</div>\n\t\t\t\t\t\t</div>\n\t\t\t\t\t</div>\n\n\t\t\t\t\t<div class=\"form-group\">\n\t\t\t\t\t\t<div class=\"checkbox\">\n\t\t\t\t\t\t\t<div class=\"col-sm-2\"></div>\n\t\t\t\t\t\t\t<div class=\"col-sm-10\">\n\t\t\t\t\t\t\t\t<input type=\"checkbox\" name=\"inputGalleryUseTags\" id=\"inputGalleryUseTags\" [(ngModel)]=\"useTags\">\n\t\t\t\t\t\t\t\t<label for=\"inputGalleryUseTags\" class=\"control-label\">Populate from tags</label>\n\t\t\t\t\t\t\t</div>\n\t\t\t\t\t\t</div>\n\t\t\t\t\t</div>\n\t\t\t\t</div>\n\n\t\t\t\t<div class=\"modal-footer\">\n\t\t\t\t\t<button type=\"button\" class=\"btn btn-default\" data-dismiss=\"modal\">Close</button>\n\t\t\t\t\t<input (click)=\"onSubmit()\" type=\"submit\" class=\"btn btn-primary\" value=\"Save changes\">\n\t\t\t\t</div>\n\t\t\t</form>\n\t\t</div><!-- /.modal-content -->\n\t</div><!-- /.modal-dialog -->\n</div><!-- /.modal -->\n"

/***/ }),

/***/ "./node_modules/raw-loader/index.js!./src/app/gallery/gallery-info/gallery-info.component.html":
/*!********************************************************************************************!*\
  !*** ./node_modules/raw-loader!./src/app/gallery/gallery-info/gallery-info.component.html ***!
  \********************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = "<h1>{{gallery.name}}</h1>\n<p>\n\t{{gallery.description}}\n</p>"

/***/ }),

/***/ "./node_modules/raw-loader/index.js!./src/app/gallery/gallery-list/gallery-list.component.html":
/*!********************************************************************************************!*\
  !*** ./node_modules/raw-loader!./src/app/gallery/gallery-list/gallery-list.component.html ***!
  \********************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = "<div class=\"row\">\n\t<ul class=\"list-unstyled\">\n\t\t<li *ngFor=\"let gallery of galleries\" class=\"thumbnail col-md-3\" style=\"min-height: 150px;\">\n\t\t\t<gallery-tile [gallery]=\"gallery\"></gallery-tile>\n\t\t</li>\n\t</ul>\n</div>"

/***/ }),

/***/ "./node_modules/raw-loader/index.js!./src/app/gallery/gallery-tile/gallery-tile.component.html":
/*!********************************************************************************************!*\
  !*** ./node_modules/raw-loader!./src/app/gallery/gallery-tile/gallery-tile.component.html ***!
  \********************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = "<a [routerLink]=\"[getLink(gallery.id)]\">\n\t<img *ngIf=\"!doesThumbExist(gallery.thumb_id)\" src=\"http://placehold.it/300x200\">\n\t<img *ngIf=\"doesThumbExist(gallery.thumb_id)\" src=\"/image/thumb/{{gallery.thumb_id}}.jpg\">\n\t<h4>{{gallery.name}}</h4>\n</a>"

/***/ }),

/***/ "./node_modules/raw-loader/index.js!./src/app/gallery/gallery-toolbar/gallery-toolbar.component.html":
/*!**************************************************************************************************!*\
  !*** ./node_modules/raw-loader!./src/app/gallery/gallery-toolbar/gallery-toolbar.component.html ***!
  \**************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = "<gallery-edit [gallery]=\"gallery\"></gallery-edit>\n<image-add [gallery]=\"gallery\"></image-add>\n\n<div class=\"row\">\n\t<div class=\"pull-right\">\n\t\t<div class=\"btn-group\" role=\"group\" aria-label=\"...\">\n\t\t\t<button type=\"button\" (click)=\"onAddGalleryClick()\" class=\"btn btn-default\" id=\"galleryAdd\" title=\"Add gallery\" data-toggle=\"tooltip\"><span class=\"glyphicon glyphicon-th\"></span></button>\n\t\t\t<button type=\"button\" (click)=\"onAddImageClick()\" class=\"btn btn-default\" id=\"imageAdd\" title=\"Add image\" data-toggle=\"tooltip\"><span class=\"glyphicon glyphicon-picture\"></span></button>\n\t\t\t<button type=\"button\" (click)=\"onEditClick()\" class=\"btn btn-default\" id=\"galleryEdit\" title=\"Edit gallery\" data-toggle=\"tooltip\"><span class=\"glyphicon glyphicon-pencil\"></span></button>\n\t\t\t<button type=\"button\" (click)=\"onDeleteClick()\" class=\"btn btn-default\" id=\"galleryDelete\" title=\"Delete gallery\" data-toggle=\"tooltip\"><span class=\"glyphicon glyphicon-trash\"></span></button>\n\t\t</div>\n\t</div>\n</div>"

/***/ }),

/***/ "./node_modules/raw-loader/index.js!./src/app/home/home-toolbar/home-toolbar.component.html":
/*!*****************************************************************************************!*\
  !*** ./node_modules/raw-loader!./src/app/home/home-toolbar/home-toolbar.component.html ***!
  \*****************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = "<gallery-edit [gallery]=\"gallery\"></gallery-edit>\n\n<div class=\"row\">\n\t<div class=\"pull-right\">\n\t\t<div class=\"btn-group\" role=\"group\" aria-label=\"...\">\n\t\t\t<button type=\"button\" (click)=\"onAddGalleryClick()\" class=\"btn btn-default\" id=\"galleryAdd\" title=\"Add gallery\" data-toggle=\"tooltip\"><span class=\"glyphicon glyphicon-th\"></span></button>\n\t\t</div>\n\t</div>\n</div>"

/***/ }),

/***/ "./node_modules/raw-loader/index.js!./src/app/image/image-add/image-add.component.html":
/*!************************************************************************************!*\
  !*** ./node_modules/raw-loader!./src/app/image/image-add/image-add.component.html ***!
  \************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = "<div class=\"modal fade\" id=\"add-modal\">\n\t<div class=\"modal-dialog\">\n\t\t<div class=\"modal-content\">\n\t\t\t<div class=\"modal-header\">\n\t\t\t\t<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>\n\t\t\t\t<h4 class=\"modal-title\">Add image</h4>\n\t\t\t</div>\n\t\t\t<form action=\"\" method=\"post\" class=\"form-horizontal\">\n\t\t\t\t<div class=\"modal-body\">\n\n\t\t\t\t\t<div class=\"form-group\">\n\t\t\t\t\t\t<label for=\"inputImageDescription\" class=\"col-sm-2 control-label\">Description</label>\n\t\t\t\t\t\t<div class=\"col-sm-10\">\n\t\t\t\t\t\t\t<textarea class=\"form-control\" name=\"inputImageDescription\" id=\"inputImageDescription\" placeholder=\"Edit...\" [(ngModel)]=\"description\"></textarea>\n\t\t\t\t\t\t</div>\n\t\t\t\t\t</div>\n\n\t\t\t\t\t<div class=\"form-group\">\n\t\t\t\t\t\t<label for=\"inputImageTags\" class=\"col-sm-2 control-label\">Tags</label>\n\t\t\t\t\t\t<div class=\"col-sm-10\">\n\t\t\t\t\t\t\t<select class=\"form-control\" name=\"inputImageTags[]\" id=\"inputImageTags\" style=\"width: 100%\" multiple>\n\t\t\t\t\t\t\t\t<option *ngFor=\"let tag of tagList\" value=\"{{tag.id}}\" selected=\"selected\">{{tag.name}}</option>\n\t\t\t\t\t\t\t</select>\n\t\t\t\t\t\t</div>\n\t\t\t\t\t</div>\n\n\t\t\t\t\t<div class=\"form-group\">\n\t\t\t\t\t\t<label for=\"inputImageTags\" class=\"col-sm-2 control-label\">Image</label>\n\t\t\t\t\t\t<div class=\"col-sm-10\">\n\t\t\t\t\t\t\t<p-fileUpload url=\"/api/upload\" name=\"myfile[]\" accept=\"image/*\" auto=\"auto\" (onUpload)=\"onUpload($event)\" multiple=\"multiple\">\n\t\t\t\t\t\t\t\t<ng-template pTemplate=\"content\">\n\t\t\t\t\t\t\t\t\t<ul *ngIf=\"uploadedFiles.length\" class=\"list-unstyled uploaded-image-list\">\n\t\t\t\t\t\t\t\t\t\t<li *ngFor=\"let file of uploadedFiles\">\n\t\t\t\t\t\t\t\t\t\t\t<img width=\"50\" src=\"/image/uploaded/{{file.hash}}\">\n\t\t\t\t\t\t\t\t\t\t\t{{file.name}} - {{file.size}} bytes\n\t\t\t\t\t\t\t\t\t\t\t<a href=\"#\" (click)=\"fileDelete($event, file)\">\n\t\t\t\t\t\t\t\t\t\t\t\t<span class=\"glyphicon glyphicon-trash\"></span>\n\t\t\t\t\t\t\t\t\t\t\t</a>\n\t\t\t\t\t\t\t\t\t\t</li>\n\t\t\t\t\t\t\t\t\t</ul>\n\t\t\t\t\t\t\t\t</ng-template>\n\t\t\t\t\t\t\t</p-fileUpload>\n\t\t\t\t\t\t</div>\n\t\t\t\t\t</div>\n\t\t\t\t</div>\n\n\t\t\t\t<div class=\"modal-footer\">\n\t\t\t\t\t<button type=\"button\" class=\"btn btn-default\" data-dismiss=\"modal\">Close</button>\n\t\t\t\t\t<input (click)=\"onSubmit()\" type=\"submit\" class=\"btn btn-primary\" value=\"Save changes\">\n\t\t\t\t</div>\n\t\t\t</form>\n\t\t</div><!-- /.modal-content -->\n\t</div><!-- /.modal-dialog -->\n</div><!-- /.modal -->\n"

/***/ }),

/***/ "./node_modules/raw-loader/index.js!./src/app/image/image-edit/image-edit.component.html":
/*!**************************************************************************************!*\
  !*** ./node_modules/raw-loader!./src/app/image/image-edit/image-edit.component.html ***!
  \**************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = "<div class=\"modal fade\" id=\"edit-modal\">\n\t<div class=\"modal-dialog\">\n\t\t<div class=\"modal-content\">\n\t\t\t<div class=\"modal-header\">\n\t\t\t\t<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>\n\t\t\t\t<h4 class=\"modal-title\">Edit image</h4>\n\t\t\t</div>\n\t\t\t<form action=\"\" method=\"post\" class=\"form-horizontal\">\n\t\t\t\t<div class=\"modal-body\">\n\n\t\t\t\t\t<div class=\"form-group\">\n\t\t\t\t\t\t<label for=\"inputImageDescription\" class=\"col-sm-2 control-label\">Description</label>\n\t\t\t\t\t\t<div class=\"col-sm-10\">\n\t\t\t\t\t\t\t<textarea class=\"form-control\" name=\"inputImageDescription\" id=\"inputImageDescription\" placeholder=\"Edit...\" [(ngModel)]=\"description\"></textarea>\n\t\t\t\t\t\t</div>\n\t\t\t\t\t</div>\n\n\t\t\t\t\t<div class=\"form-group\">\n\t\t\t\t\t\t<label for=\"inputImageTags\" class=\"col-sm-2 control-label\">Tags</label>\n\t\t\t\t\t\t<div class=\"col-sm-10\">\n\t\t\t\t\t\t\t<select class=\"form-control\" name=\"inputImageTags[]\" id=\"inputImageTags\" style=\"width: 100%\" multiple>\n\t\t\t\t\t\t\t\t<option *ngFor=\"let tag of tagList\" value=\"{{tag.id}}\" selected=\"selected\">{{tag.name}}</option>\n\t\t\t\t\t\t\t</select>\n\t\t\t\t\t\t</div>\n\t\t\t\t\t</div>\n\t\t\t\t</div>\n\n\t\t\t\t<div class=\"modal-footer\">\n\t\t\t\t\t<button type=\"button\" class=\"btn btn-default\" data-dismiss=\"modal\">Close</button>\n\t\t\t\t\t<input (click)=\"onSubmit()\" type=\"submit\" class=\"btn btn-primary\" value=\"Save changes\">\n\t\t\t\t</div>\n\t\t\t</form>\n\t\t</div><!-- /.modal-content -->\n\t</div><!-- /.modal-dialog -->\n</div><!-- /.modal -->\n"

/***/ }),

/***/ "./node_modules/raw-loader/index.js!./src/app/image/image-info/image-info.component.html":
/*!**************************************************************************************!*\
  !*** ./node_modules/raw-loader!./src/app/image/image-info/image-info.component.html ***!
  \**************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = "<div class=\"moa-page\">\n\t<p>\n\t\t{{image.description}}\n\t</p>\n\t<div class=\"image-container\">\n\t\t<a [href]=\"getFullImageUrl()\" ng-box [title]=\"image.filename\" class=\"image-lightbox-link\">\n\t\t\t<img src=\"{{image.image_src}}\">\n\t\t</a>\n\t</div>\n\t<br>\n\t<div class=\"row\">\n\t\t<a [href]=\"getFullImageUrl()\" target=\"_blank\" class=\"btn btn-info col-md-2 col-md-offset-5\">\n\t\t\t<span class=\"glyphicon glyphicon-new-window pull-left\"></span> Open in new tab\n\t\t</a>\n\t</div>\n</div>\n<ngbox></ngbox>"

/***/ }),

/***/ "./node_modules/raw-loader/index.js!./src/app/image/image-list/image-list.component.html":
/*!**************************************************************************************!*\
  !*** ./node_modules/raw-loader!./src/app/image/image-list/image-list.component.html ***!
  \**************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = "<ul class=\"list-unstyled\">\n\t<li *ngFor=\"let image of images\" class=\"thumbnail\">\n\t\t<image-thumb [image]=\"image\" [gallery_id]=\"gallery.id\">\n\t\t</image-thumb>\n\t</li>\n</ul>\n"

/***/ }),

/***/ "./node_modules/raw-loader/index.js!./src/app/image/image-thumb/image-thumb.component.html":
/*!****************************************************************************************!*\
  !*** ./node_modules/raw-loader!./src/app/image/image-thumb/image-thumb.component.html ***!
  \****************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = "<div>\n\t<a [routerLink]=\"[getLink()]\">\n\t\t<img *ngIf=\"!image.isGenerating && image.displayWidth <= 450 && image.displayHeight <= 300\" src=\"/image/thumb/{{image.id}}.jpg\" [ngStyle]=\"{width: (image.displayWidth - 10) + 'px', height: image.displayHeight + 'px'}\">\n\t\t<img *ngIf=\"!image.isGenerating && (image.displayWidth > 450 || image.displayHeight > 300)\" src=\"/image/thumb/{{image.id}}-w.jpg\" [ngStyle]=\"{width: (image.displayWidth - 10) + 'px', height: image.displayHeight + 'px'}\">\n\t\t<img *ngIf=\"image.isGenerating\" src=\"/media/spinner.svg\" class=\"thumbnail-generating\">\n\t\t<span>{{image.filename}}</span>\n\t</a>\n</div>\n"

/***/ }),

/***/ "./node_modules/raw-loader/index.js!./src/app/image/image-toolbar/image-toolbar.component.html":
/*!********************************************************************************************!*\
  !*** ./node_modules/raw-loader!./src/app/image/image-toolbar/image-toolbar.component.html ***!
  \********************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = "<image-edit [image]=\"image\"></image-edit>\n\n<div class=\"row\">\n\t<div class=\"pull-right\">\n\t\t<div class=\"btn-group\" role=\"group\" aria-label=\"...\">\n\t\t\t<button type=\"button\" (click)=\"onEditClick()\" class=\"btn btn-default\" id=\"imageEdit\" title=\"Edit image\" data-toggle=\"tooltip\"><span class=\"glyphicon glyphicon-pencil\"></span></button>\n\t\t\t<button type=\"button\" (click)=\"onDeleteClick()\" class=\"btn btn-default\" id=\"imageDelete\" title=\"Delete image\" data-toggle=\"tooltip\"><span class=\"glyphicon glyphicon-trash\"></span></button>\n\t\t</div>\n\t</div>\n</div>"

/***/ }),

/***/ "./node_modules/raw-loader/index.js!./src/app/pages/gallery-page/gallery-page.component.html":
/*!******************************************************************************************!*\
  !*** ./node_modules/raw-loader!./src/app/pages/gallery-page/gallery-page.component.html ***!
  \******************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = "<gallery-toolbar></gallery-toolbar>\n<gallery-info></gallery-info>\n<gallery-list></gallery-list>\n<image-list></image-list>"

/***/ }),

/***/ "./node_modules/raw-loader/index.js!./src/app/pages/home-page/home-page.component.html":
/*!************************************************************************************!*\
  !*** ./node_modules/raw-loader!./src/app/pages/home-page/home-page.component.html ***!
  \************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = "<home-toolbar></home-toolbar>\n\n<gallery-list></gallery-list>"

/***/ }),

/***/ "./node_modules/raw-loader/index.js!./src/app/pages/image-page/image-page.component.html":
/*!**************************************************************************************!*\
  !*** ./node_modules/raw-loader!./src/app/pages/image-page/image-page.component.html ***!
  \**************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = "<image-toolbar></image-toolbar>\n<image-info></image-info>"

/***/ }),

/***/ "./src/$$_lazy_route_resource lazy recursive":
/*!**********************************************************!*\
  !*** ./src/$$_lazy_route_resource lazy namespace object ***!
  \**********************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

function webpackEmptyAsyncContext(req) {
	// Here Promise.resolve().then() is used instead of new Promise() to prevent
	// uncaught exception popping up in devtools
	return Promise.resolve().then(function() {
		var e = new Error("Cannot find module '" + req + "'");
		e.code = 'MODULE_NOT_FOUND';
		throw e;
	});
}
webpackEmptyAsyncContext.keys = function() { return []; };
webpackEmptyAsyncContext.resolve = webpackEmptyAsyncContext;
module.exports = webpackEmptyAsyncContext;
webpackEmptyAsyncContext.id = "./src/$$_lazy_route_resource lazy recursive";

/***/ }),

/***/ "./src/app/app.component.css":
/*!***********************************!*\
  !*** ./src/app/app.component.css ***!
  \***********************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = "\n/*# sourceMappingURL=data:application/json;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbXSwibmFtZXMiOltdLCJtYXBwaW5ncyI6IiIsImZpbGUiOiJzcmMvYXBwL2FwcC5jb21wb25lbnQuY3NzIn0= */"

/***/ }),

/***/ "./src/app/app.component.ts":
/*!**********************************!*\
  !*** ./src/app/app.component.ts ***!
  \**********************************/
/*! exports provided: AppComponent */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "AppComponent", function() { return AppComponent; });
/* harmony import */ var tslib__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! tslib */ "./node_modules/tslib/tslib.es6.js");
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @angular/core */ "./node_modules/@angular/core/fesm2015/core.js");
/* harmony import */ var _services_data_service__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./services/data.service */ "./src/app/services/data.service.ts");
/* harmony import */ var _angular_router__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @angular/router */ "./node_modules/@angular/router/fesm2015/router.js");
/* harmony import */ var _services_page_title_service__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ./services/page_title.service */ "./src/app/services/page_title.service.ts");





let AppComponent = class AppComponent {
    constructor(router, service, pageTitleService, elementRef) {
        this.router = router;
        this.service = service;
        this.pageTitleService = pageTitleService;
        this.elementRef = elementRef;
        this.preload = {};
        this.data = [];
        this.preload = JSON.parse(this.elementRef.nativeElement.getAttribute('[preload]'));
    }
    ngOnInit() {
        this.service.setPageData(this.preload);
    }
};
AppComponent = tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"]([
    Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Component"])({
        selector: 'app-root',
        template: __webpack_require__(/*! raw-loader!./app.component.html */ "./node_modules/raw-loader/index.js!./src/app/app.component.html"),
        styles: [__webpack_require__(/*! ./app.component.css */ "./src/app/app.component.css")]
    }),
    tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"]("design:paramtypes", [_angular_router__WEBPACK_IMPORTED_MODULE_3__["Router"],
        _services_data_service__WEBPACK_IMPORTED_MODULE_2__["DataService"],
        _services_page_title_service__WEBPACK_IMPORTED_MODULE_4__["PageTitleService"],
        _angular_core__WEBPACK_IMPORTED_MODULE_1__["ElementRef"]])
], AppComponent);



/***/ }),

/***/ "./src/app/app.module.ts":
/*!*******************************!*\
  !*** ./src/app/app.module.ts ***!
  \*******************************/
/*! exports provided: AppModule */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "AppModule", function() { return AppModule; });
/* harmony import */ var tslib__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! tslib */ "./node_modules/tslib/tslib.es6.js");
/* harmony import */ var _angular_platform_browser__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @angular/platform-browser */ "./node_modules/@angular/platform-browser/fesm2015/platform-browser.js");
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @angular/core */ "./node_modules/@angular/core/fesm2015/core.js");
/* harmony import */ var _app_component__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./app.component */ "./src/app/app.component.ts");
/* harmony import */ var _breadcrumb_breadcrumb_component__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ./breadcrumb/breadcrumb.component */ "./src/app/breadcrumb/breadcrumb.component.ts");
/* harmony import */ var _gallery_gallery_list_gallery_list_component__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! ./gallery/gallery-list/gallery-list.component */ "./src/app/gallery/gallery-list/gallery-list.component.ts");
/* harmony import */ var _gallery_gallery_tile_gallery_tile_component__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! ./gallery/gallery-tile/gallery-tile.component */ "./src/app/gallery/gallery-tile/gallery-tile.component.ts");
/* harmony import */ var _services_data_service__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(/*! ./services/data.service */ "./src/app/services/data.service.ts");
/* harmony import */ var _services_page_title_service__WEBPACK_IMPORTED_MODULE_8__ = __webpack_require__(/*! ./services/page_title.service */ "./src/app/services/page_title.service.ts");
/* harmony import */ var _services_page_data_service__WEBPACK_IMPORTED_MODULE_9__ = __webpack_require__(/*! ./services/page_data.service */ "./src/app/services/page_data.service.ts");
/* harmony import */ var _angular_common_http__WEBPACK_IMPORTED_MODULE_10__ = __webpack_require__(/*! @angular/common/http */ "./node_modules/@angular/common/fesm2015/http.js");
/* harmony import */ var _angular_router__WEBPACK_IMPORTED_MODULE_11__ = __webpack_require__(/*! @angular/router */ "./node_modules/@angular/router/fesm2015/router.js");
/* harmony import */ var _pages_gallery_page_gallery_page_component__WEBPACK_IMPORTED_MODULE_12__ = __webpack_require__(/*! ./pages/gallery-page/gallery-page.component */ "./src/app/pages/gallery-page/gallery-page.component.ts");
/* harmony import */ var _pages_home_page_home_page_component__WEBPACK_IMPORTED_MODULE_13__ = __webpack_require__(/*! ./pages/home-page/home-page.component */ "./src/app/pages/home-page/home-page.component.ts");
/* harmony import */ var _gallery_gallery_info_gallery_info_component__WEBPACK_IMPORTED_MODULE_14__ = __webpack_require__(/*! ./gallery/gallery-info/gallery-info.component */ "./src/app/gallery/gallery-info/gallery-info.component.ts");
/* harmony import */ var _image_image_list_image_list_component__WEBPACK_IMPORTED_MODULE_15__ = __webpack_require__(/*! ./image/image-list/image-list.component */ "./src/app/image/image-list/image-list.component.ts");
/* harmony import */ var _image_image_thumb_image_thumb_component__WEBPACK_IMPORTED_MODULE_16__ = __webpack_require__(/*! ./image/image-thumb/image-thumb.component */ "./src/app/image/image-thumb/image-thumb.component.ts");
/* harmony import */ var _gallery_gallery_toolbar_gallery_toolbar_component__WEBPACK_IMPORTED_MODULE_17__ = __webpack_require__(/*! ./gallery/gallery-toolbar/gallery-toolbar.component */ "./src/app/gallery/gallery-toolbar/gallery-toolbar.component.ts");
/* harmony import */ var _gallery_gallery_edit_gallery_edit_component__WEBPACK_IMPORTED_MODULE_18__ = __webpack_require__(/*! ./gallery/gallery-edit/gallery-edit.component */ "./src/app/gallery/gallery-edit/gallery-edit.component.ts");
/* harmony import */ var _services_button_click_service__WEBPACK_IMPORTED_MODULE_19__ = __webpack_require__(/*! ./services/button-click.service */ "./src/app/services/button-click.service.ts");
/* harmony import */ var _angular_forms__WEBPACK_IMPORTED_MODULE_20__ = __webpack_require__(/*! @angular/forms */ "./node_modules/@angular/forms/fesm2015/forms.js");
/* harmony import */ var _services_gallery_service__WEBPACK_IMPORTED_MODULE_21__ = __webpack_require__(/*! ./services/gallery_service */ "./src/app/services/gallery_service.ts");
/* harmony import */ var _services_image_service__WEBPACK_IMPORTED_MODULE_22__ = __webpack_require__(/*! ./services/image_service */ "./src/app/services/image_service.ts");
/* harmony import */ var _pages_image_page_image_page_component__WEBPACK_IMPORTED_MODULE_23__ = __webpack_require__(/*! ./pages/image-page/image-page.component */ "./src/app/pages/image-page/image-page.component.ts");
/* harmony import */ var _image_image_info_image_info_component__WEBPACK_IMPORTED_MODULE_24__ = __webpack_require__(/*! ./image/image-info/image-info.component */ "./src/app/image/image-info/image-info.component.ts");
/* harmony import */ var _image_image_toolbar_image_toolbar_component__WEBPACK_IMPORTED_MODULE_25__ = __webpack_require__(/*! ./image/image-toolbar/image-toolbar.component */ "./src/app/image/image-toolbar/image-toolbar.component.ts");
/* harmony import */ var _image_image_edit_image_edit_component__WEBPACK_IMPORTED_MODULE_26__ = __webpack_require__(/*! ./image/image-edit/image-edit.component */ "./src/app/image/image-edit/image-edit.component.ts");
/* harmony import */ var _services_thumbnail_service__WEBPACK_IMPORTED_MODULE_27__ = __webpack_require__(/*! ./services/thumbnail.service */ "./src/app/services/thumbnail.service.ts");
/* harmony import */ var _image_image_add_image_add_component__WEBPACK_IMPORTED_MODULE_28__ = __webpack_require__(/*! ./image/image-add/image-add.component */ "./src/app/image/image-add/image-add.component.ts");
/* harmony import */ var primeng_components_fileupload_fileupload__WEBPACK_IMPORTED_MODULE_29__ = __webpack_require__(/*! primeng/components/fileupload/fileupload */ "./node_modules/primeng/components/fileupload/fileupload.js");
/* harmony import */ var primeng_components_fileupload_fileupload__WEBPACK_IMPORTED_MODULE_29___default = /*#__PURE__*/__webpack_require__.n(primeng_components_fileupload_fileupload__WEBPACK_IMPORTED_MODULE_29__);
/* harmony import */ var _home_home_toolbar_home_toolbar_component__WEBPACK_IMPORTED_MODULE_30__ = __webpack_require__(/*! ./home/home-toolbar/home-toolbar.component */ "./src/app/home/home-toolbar/home-toolbar.component.ts");
/* harmony import */ var _ngbox_ngbox_service__WEBPACK_IMPORTED_MODULE_31__ = __webpack_require__(/*! ./ngbox/ngbox.service */ "./src/app/ngbox/ngbox.service.ts");
/* harmony import */ var _ngbox_ngbox_component__WEBPACK_IMPORTED_MODULE_32__ = __webpack_require__(/*! ./ngbox/ngbox.component */ "./src/app/ngbox/ngbox.component.ts");
/* harmony import */ var _ngbox_ngbox_directive__WEBPACK_IMPORTED_MODULE_33__ = __webpack_require__(/*! ./ngbox/ngbox.directive */ "./src/app/ngbox/ngbox.directive.ts");


































const routes = [
    { path: '', component: _pages_home_page_home_page_component__WEBPACK_IMPORTED_MODULE_13__["HomePageComponent"] },
    { path: 'gallery/:id', component: _pages_gallery_page_gallery_page_component__WEBPACK_IMPORTED_MODULE_12__["GalleryPageComponent"] },
    { path: 'image/:gallery_id/:image_id', component: _pages_image_page_image_page_component__WEBPACK_IMPORTED_MODULE_23__["ImagePageComponent"] }
];
let AppModule = class AppModule {
};
AppModule = tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"]([
    Object(_angular_core__WEBPACK_IMPORTED_MODULE_2__["NgModule"])({
        declarations: [
            _app_component__WEBPACK_IMPORTED_MODULE_3__["AppComponent"],
            _breadcrumb_breadcrumb_component__WEBPACK_IMPORTED_MODULE_4__["BreadcrumbComponent"],
            _gallery_gallery_list_gallery_list_component__WEBPACK_IMPORTED_MODULE_5__["GalleryListComponent"],
            _gallery_gallery_tile_gallery_tile_component__WEBPACK_IMPORTED_MODULE_6__["GalleryTileComponent"],
            _gallery_gallery_info_gallery_info_component__WEBPACK_IMPORTED_MODULE_14__["GalleryInfoComponent"],
            _gallery_gallery_toolbar_gallery_toolbar_component__WEBPACK_IMPORTED_MODULE_17__["GalleryToolbarComponent"],
            _gallery_gallery_edit_gallery_edit_component__WEBPACK_IMPORTED_MODULE_18__["GalleryEditComponent"],
            _image_image_list_image_list_component__WEBPACK_IMPORTED_MODULE_15__["ImageListComponent"],
            _image_image_thumb_image_thumb_component__WEBPACK_IMPORTED_MODULE_16__["ImageThumbComponent"],
            _image_image_info_image_info_component__WEBPACK_IMPORTED_MODULE_24__["ImageInfoComponent"],
            _home_home_toolbar_home_toolbar_component__WEBPACK_IMPORTED_MODULE_30__["HomeToolbarComponent"],
            // Route pages
            _pages_home_page_home_page_component__WEBPACK_IMPORTED_MODULE_13__["HomePageComponent"],
            _pages_gallery_page_gallery_page_component__WEBPACK_IMPORTED_MODULE_12__["GalleryPageComponent"],
            _pages_image_page_image_page_component__WEBPACK_IMPORTED_MODULE_23__["ImagePageComponent"],
            _image_image_toolbar_image_toolbar_component__WEBPACK_IMPORTED_MODULE_25__["ImageToolbarComponent"],
            _image_image_edit_image_edit_component__WEBPACK_IMPORTED_MODULE_26__["ImageEditComponent"],
            _image_image_add_image_add_component__WEBPACK_IMPORTED_MODULE_28__["ImageAddComponent"],
            _ngbox_ngbox_component__WEBPACK_IMPORTED_MODULE_32__["NgBoxComponent"],
            _ngbox_ngbox_directive__WEBPACK_IMPORTED_MODULE_33__["NgBoxDirective"]
        ],
        imports: [
            _angular_platform_browser__WEBPACK_IMPORTED_MODULE_1__["BrowserModule"],
            _angular_common_http__WEBPACK_IMPORTED_MODULE_10__["HttpClientModule"],
            _angular_router__WEBPACK_IMPORTED_MODULE_11__["RouterModule"].forRoot(routes),
            _angular_forms__WEBPACK_IMPORTED_MODULE_20__["FormsModule"],
            primeng_components_fileupload_fileupload__WEBPACK_IMPORTED_MODULE_29__["FileUploadModule"]
        ],
        providers: [
            _services_data_service__WEBPACK_IMPORTED_MODULE_7__["DataService"],
            _services_page_title_service__WEBPACK_IMPORTED_MODULE_8__["PageTitleService"],
            _services_page_data_service__WEBPACK_IMPORTED_MODULE_9__["PageDataService"],
            _services_button_click_service__WEBPACK_IMPORTED_MODULE_19__["ButtonClickService"],
            _services_gallery_service__WEBPACK_IMPORTED_MODULE_21__["GalleryService"],
            _services_image_service__WEBPACK_IMPORTED_MODULE_22__["ImageService"],
            _services_thumbnail_service__WEBPACK_IMPORTED_MODULE_27__["ThumbnailService"],
            _ngbox_ngbox_service__WEBPACK_IMPORTED_MODULE_31__["NgBoxService"]
        ],
        bootstrap: [
            _app_component__WEBPACK_IMPORTED_MODULE_3__["AppComponent"]
        ]
    })
], AppModule);



/***/ }),

/***/ "./src/app/breadcrumb/breadcrumb.component.css":
/*!*****************************************************!*\
  !*** ./src/app/breadcrumb/breadcrumb.component.css ***!
  \*****************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = "\n/*# sourceMappingURL=data:application/json;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbXSwibmFtZXMiOltdLCJtYXBwaW5ncyI6IiIsImZpbGUiOiJzcmMvYXBwL2JyZWFkY3J1bWIvYnJlYWRjcnVtYi5jb21wb25lbnQuY3NzIn0= */"

/***/ }),

/***/ "./src/app/breadcrumb/breadcrumb.component.ts":
/*!****************************************************!*\
  !*** ./src/app/breadcrumb/breadcrumb.component.ts ***!
  \****************************************************/
/*! exports provided: BreadcrumbComponent */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "BreadcrumbComponent", function() { return BreadcrumbComponent; });
/* harmony import */ var tslib__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! tslib */ "./node_modules/tslib/tslib.es6.js");
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @angular/core */ "./node_modules/@angular/core/fesm2015/core.js");
/* harmony import */ var _services_data_service__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../services/data.service */ "./src/app/services/data.service.ts");



let BreadcrumbComponent = class BreadcrumbComponent {
    constructor(service) {
        this.service = service;
        this.observer = service.getBreadcrumbObserver().subscribe(data => {
            this.crumbs = data;
        });
    }
    ngOnDestroy() {
        this.observer.unsubscribe();
    }
    getLink(id) {
        for (let i = 0; i < this.crumbs.length; i++) {
            if (this.crumbs[i].id == id) {
                return '/' + this.crumbs[i].type + '/' + this.crumbs[i].id;
            }
        }
        return '/';
    }
};
BreadcrumbComponent = tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"]([
    Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Component"])({
        selector: 'breadcrumb',
        template: __webpack_require__(/*! raw-loader!./breadcrumb.component.html */ "./node_modules/raw-loader/index.js!./src/app/breadcrumb/breadcrumb.component.html"),
        styles: [__webpack_require__(/*! ./breadcrumb.component.css */ "./src/app/breadcrumb/breadcrumb.component.css")]
    }),
    tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"]("design:paramtypes", [_services_data_service__WEBPACK_IMPORTED_MODULE_2__["DataService"]])
], BreadcrumbComponent);



/***/ }),

/***/ "./src/app/gallery/gallery-edit/gallery-edit.component.css":
/*!*****************************************************************!*\
  !*** ./src/app/gallery/gallery-edit/gallery-edit.component.css ***!
  \*****************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = "\n/*# sourceMappingURL=data:application/json;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbXSwibmFtZXMiOltdLCJtYXBwaW5ncyI6IiIsImZpbGUiOiJzcmMvYXBwL2dhbGxlcnkvZ2FsbGVyeS1lZGl0L2dhbGxlcnktZWRpdC5jb21wb25lbnQuY3NzIn0= */"

/***/ }),

/***/ "./src/app/gallery/gallery-edit/gallery-edit.component.ts":
/*!****************************************************************!*\
  !*** ./src/app/gallery/gallery-edit/gallery-edit.component.ts ***!
  \****************************************************************/
/*! exports provided: GalleryEditComponent */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "GalleryEditComponent", function() { return GalleryEditComponent; });
/* harmony import */ var tslib__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! tslib */ "./node_modules/tslib/tslib.es6.js");
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @angular/core */ "./node_modules/@angular/core/fesm2015/core.js");
/* harmony import */ var _services_button_click_service__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../services/button-click.service */ "./src/app/services/button-click.service.ts");
/* harmony import */ var _services_gallery_service__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../../services/gallery_service */ "./src/app/services/gallery_service.ts");
/* harmony import */ var _angular_router__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! @angular/router */ "./node_modules/@angular/router/fesm2015/router.js");





let GalleryEditComponent = class GalleryEditComponent {
    constructor(buttonClickService, galleryService, router) {
        this.buttonClickService = buttonClickService;
        this.galleryService = galleryService;
        this.router = router;
        this.addMode = false;
        this.tagList = [];
        this.parent_gallery = {
            id: 0,
            name: ''
        };
        this.name = '';
        this.description = '';
        this.useTags = false;
        this.showImages = false;
        this.subscription = this.buttonClickService.notifyObservable$.subscribe(data => {
            if ((data.name !== 'galleryEditClick') &&
                (data.name !== 'galleryAddClick')) {
                return;
            }
            this.addMode = data.name === 'galleryAddClick';
            this.reset();
            $('#edit-modal').modal('show');
            setTimeout(function () {
                $('#inputGalleryParent').select2({
                    ajax: {
                        url: '/api/gallery_lookup',
                        dataType: 'json',
                        data: function (params) {
                            return {
                                q: params.term,
                                page: params.page || 1
                            };
                        }
                    }
                });
                $('#inputGalleryTags').select2({
                    tags: true,
                    ajax: {
                        url: '/api/tag_lookup',
                        dataType: 'json',
                        data: function (params) {
                            return {
                                q: params.term,
                                page: params.page || 1
                            };
                        }
                    }
                });
            }, 0);
        });
    }
    reset() {
        if (!this.addMode) {
            this.name = this.gallery.name;
            this.description = this.gallery.description;
            this.useTags = this.gallery.use_tags == 1;
            this.showImages = this.gallery.combined_view == 1;
            this.parent_gallery.id = this.gallery.parent_gallery.id;
            this.parent_gallery.name = this.gallery.parent_gallery.name;
        }
        else {
            this.name = '';
            this.description = '';
            this.useTags = true;
            this.showImages = false;
            this.parent_gallery.id = this.gallery.id;
            this.parent_gallery.name = this.gallery.name;
        }
        this.tagList = [];
        for (let tag of this.gallery.tag_list) {
            this.tagList.push({ name: tag.name, id: '' + tag.id });
        }
    }
    onSubmit() {
        // Select2 isn't synchronising so we have to get the selections manually
        let tagData = $('#inputGalleryTags').select2('data');
        let tags = [];
        for (let tag of tagData) {
            tags.push(tag.id);
        }
        let galleryData = $('#inputGalleryParent').select2('data');
        this.parent_gallery.id = galleryData[0].id;
        let id = 0;
        if (!this.addMode)
            id = this.gallery.id;
        this.galleryService.SubmitGallery({
            id: id,
            name: this.name,
            description: this.description,
            parent: this.parent_gallery.id,
            tags: tags,
            useTags: this.useTags,
            showImages: this.showImages
        }).subscribe(data => {
            let options = {
                message: 'Gallery saved',
                container: '#editSuccessContainer',
                duration: 5000
            };
            $.meow(options);
            $('#inputGalleryTags').children().remove();
            $('#edit-modal').modal('hide');
            if (this.addMode) {
                this.router.navigate(['/gallery/' + data.message]);
            }
        });
    }
    ngOnDestroy() {
        this.subscription.unsubscribe();
    }
};
tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"]([
    Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Input"])(),
    tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"]("design:type", Object)
], GalleryEditComponent.prototype, "gallery", void 0);
GalleryEditComponent = tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"]([
    Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Component"])({
        selector: 'gallery-edit',
        template: __webpack_require__(/*! raw-loader!./gallery-edit.component.html */ "./node_modules/raw-loader/index.js!./src/app/gallery/gallery-edit/gallery-edit.component.html"),
        styles: [__webpack_require__(/*! ./gallery-edit.component.css */ "./src/app/gallery/gallery-edit/gallery-edit.component.css")]
    }),
    tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"]("design:paramtypes", [_services_button_click_service__WEBPACK_IMPORTED_MODULE_2__["ButtonClickService"],
        _services_gallery_service__WEBPACK_IMPORTED_MODULE_3__["GalleryService"],
        _angular_router__WEBPACK_IMPORTED_MODULE_4__["Router"]])
], GalleryEditComponent);



/***/ }),

/***/ "./src/app/gallery/gallery-info/gallery-info.component.css":
/*!*****************************************************************!*\
  !*** ./src/app/gallery/gallery-info/gallery-info.component.css ***!
  \*****************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = "\n/*# sourceMappingURL=data:application/json;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbXSwibmFtZXMiOltdLCJtYXBwaW5ncyI6IiIsImZpbGUiOiJzcmMvYXBwL2dhbGxlcnkvZ2FsbGVyeS1pbmZvL2dhbGxlcnktaW5mby5jb21wb25lbnQuY3NzIn0= */"

/***/ }),

/***/ "./src/app/gallery/gallery-info/gallery-info.component.ts":
/*!****************************************************************!*\
  !*** ./src/app/gallery/gallery-info/gallery-info.component.ts ***!
  \****************************************************************/
/*! exports provided: GalleryInfoComponent */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "GalleryInfoComponent", function() { return GalleryInfoComponent; });
/* harmony import */ var tslib__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! tslib */ "./node_modules/tslib/tslib.es6.js");
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @angular/core */ "./node_modules/@angular/core/fesm2015/core.js");
/* harmony import */ var _services_data_service__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../services/data.service */ "./src/app/services/data.service.ts");



let GalleryInfoComponent = class GalleryInfoComponent {
    constructor(service) {
        this.service = service;
        this.gallery = {
            name: '',
            description: ''
        };
        this.observer = service.getGalleryObserver().subscribe(data => {
            this.gallery = data;
        });
    }
    ngOnDestroy() {
        this.observer.unsubscribe();
    }
};
GalleryInfoComponent = tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"]([
    Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Component"])({
        selector: 'gallery-info',
        template: __webpack_require__(/*! raw-loader!./gallery-info.component.html */ "./node_modules/raw-loader/index.js!./src/app/gallery/gallery-info/gallery-info.component.html"),
        styles: [__webpack_require__(/*! ./gallery-info.component.css */ "./src/app/gallery/gallery-info/gallery-info.component.css")]
    }),
    tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"]("design:paramtypes", [_services_data_service__WEBPACK_IMPORTED_MODULE_2__["DataService"]])
], GalleryInfoComponent);



/***/ }),

/***/ "./src/app/gallery/gallery-list/gallery-list.component.css":
/*!*****************************************************************!*\
  !*** ./src/app/gallery/gallery-list/gallery-list.component.css ***!
  \*****************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = ".thumbnail {\n    height: 250px;\n}\n/*# sourceMappingURL=data:application/json;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbInNyYy9hcHAvZ2FsbGVyeS9nYWxsZXJ5LWxpc3QvZ2FsbGVyeS1saXN0LmNvbXBvbmVudC5jc3MiXSwibmFtZXMiOltdLCJtYXBwaW5ncyI6IkFBQUE7SUFDSSxhQUFhO0FBQ2pCIiwiZmlsZSI6InNyYy9hcHAvZ2FsbGVyeS9nYWxsZXJ5LWxpc3QvZ2FsbGVyeS1saXN0LmNvbXBvbmVudC5jc3MiLCJzb3VyY2VzQ29udGVudCI6WyIudGh1bWJuYWlsIHtcbiAgICBoZWlnaHQ6IDI1MHB4O1xufSJdfQ== */"

/***/ }),

/***/ "./src/app/gallery/gallery-list/gallery-list.component.ts":
/*!****************************************************************!*\
  !*** ./src/app/gallery/gallery-list/gallery-list.component.ts ***!
  \****************************************************************/
/*! exports provided: GalleryListComponent */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "GalleryListComponent", function() { return GalleryListComponent; });
/* harmony import */ var tslib__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! tslib */ "./node_modules/tslib/tslib.es6.js");
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @angular/core */ "./node_modules/@angular/core/fesm2015/core.js");
/* harmony import */ var _services_data_service__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../services/data.service */ "./src/app/services/data.service.ts");



let GalleryListComponent = class GalleryListComponent {
    constructor(service) {
        this.service = service;
        this.observer = service.getGalleriesObserver().subscribe(data => {
            this.galleries = data;
        });
    }
    ngOnDestroy() {
        this.observer.unsubscribe();
    }
};
GalleryListComponent = tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"]([
    Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Component"])({
        selector: 'gallery-list',
        template: __webpack_require__(/*! raw-loader!./gallery-list.component.html */ "./node_modules/raw-loader/index.js!./src/app/gallery/gallery-list/gallery-list.component.html"),
        styles: [__webpack_require__(/*! ./gallery-list.component.css */ "./src/app/gallery/gallery-list/gallery-list.component.css")]
    }),
    tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"]("design:paramtypes", [_services_data_service__WEBPACK_IMPORTED_MODULE_2__["DataService"]])
], GalleryListComponent);



/***/ }),

/***/ "./src/app/gallery/gallery-tile/gallery-tile.component.css":
/*!*****************************************************************!*\
  !*** ./src/app/gallery/gallery-tile/gallery-tile.component.css ***!
  \*****************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = "\n/*# sourceMappingURL=data:application/json;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbXSwibmFtZXMiOltdLCJtYXBwaW5ncyI6IiIsImZpbGUiOiJzcmMvYXBwL2dhbGxlcnkvZ2FsbGVyeS10aWxlL2dhbGxlcnktdGlsZS5jb21wb25lbnQuY3NzIn0= */"

/***/ }),

/***/ "./src/app/gallery/gallery-tile/gallery-tile.component.ts":
/*!****************************************************************!*\
  !*** ./src/app/gallery/gallery-tile/gallery-tile.component.ts ***!
  \****************************************************************/
/*! exports provided: GalleryTileComponent */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "GalleryTileComponent", function() { return GalleryTileComponent; });
/* harmony import */ var tslib__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! tslib */ "./node_modules/tslib/tslib.es6.js");
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @angular/core */ "./node_modules/@angular/core/fesm2015/core.js");
/* harmony import */ var _models_gallery_model__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../models/gallery.model */ "./src/app/models/gallery.model.ts");



let GalleryTileComponent = class GalleryTileComponent {
    constructor() { }
    getLink(id) {
        return '/gallery/' + this.gallery.id;
    }
    doesThumbExist(thumb_id) {
        return thumb_id !== null;
    }
};
tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"]([
    Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Input"])(),
    tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"]("design:type", _models_gallery_model__WEBPACK_IMPORTED_MODULE_2__["Gallery"])
], GalleryTileComponent.prototype, "gallery", void 0);
GalleryTileComponent = tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"]([
    Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Component"])({
        selector: 'gallery-tile',
        template: __webpack_require__(/*! raw-loader!./gallery-tile.component.html */ "./node_modules/raw-loader/index.js!./src/app/gallery/gallery-tile/gallery-tile.component.html"),
        styles: [__webpack_require__(/*! ./gallery-tile.component.css */ "./src/app/gallery/gallery-tile/gallery-tile.component.css")]
    }),
    tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"]("design:paramtypes", [])
], GalleryTileComponent);



/***/ }),

/***/ "./src/app/gallery/gallery-toolbar/gallery-toolbar.component.css":
/*!***********************************************************************!*\
  !*** ./src/app/gallery/gallery-toolbar/gallery-toolbar.component.css ***!
  \***********************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = "\n/*# sourceMappingURL=data:application/json;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbXSwibmFtZXMiOltdLCJtYXBwaW5ncyI6IiIsImZpbGUiOiJzcmMvYXBwL2dhbGxlcnkvZ2FsbGVyeS10b29sYmFyL2dhbGxlcnktdG9vbGJhci5jb21wb25lbnQuY3NzIn0= */"

/***/ }),

/***/ "./src/app/gallery/gallery-toolbar/gallery-toolbar.component.ts":
/*!**********************************************************************!*\
  !*** ./src/app/gallery/gallery-toolbar/gallery-toolbar.component.ts ***!
  \**********************************************************************/
/*! exports provided: GalleryToolbarComponent */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "GalleryToolbarComponent", function() { return GalleryToolbarComponent; });
/* harmony import */ var tslib__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! tslib */ "./node_modules/tslib/tslib.es6.js");
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @angular/core */ "./node_modules/@angular/core/fesm2015/core.js");
/* harmony import */ var _services_data_service__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../services/data.service */ "./src/app/services/data.service.ts");
/* harmony import */ var _services_button_click_service__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../../services/button-click.service */ "./src/app/services/button-click.service.ts");
/* harmony import */ var _services_gallery_service__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ../../services/gallery_service */ "./src/app/services/gallery_service.ts");
/* harmony import */ var _angular_router__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! @angular/router */ "./node_modules/@angular/router/fesm2015/router.js");






let GalleryToolbarComponent = class GalleryToolbarComponent {
    constructor(dataService, buttonClickService, galleryService, router) {
        this.dataService = dataService;
        this.buttonClickService = buttonClickService;
        this.galleryService = galleryService;
        this.router = router;
        this.gallery = {
            id: 0,
            parent_id: 0,
            name: '',
            description: ''
        };
        this.observer = dataService.getGalleryObserver().subscribe(data => {
            this.gallery = data;
        });
    }
    onEditClick() {
        this.buttonClickService.trigger('galleryEditClick');
    }
    onAddGalleryClick() {
        this.buttonClickService.trigger('galleryAddClick');
    }
    onAddImageClick() {
        this.buttonClickService.trigger('imageAddClick');
    }
    onDeleteClick() {
        if (confirm('Delete this gallery?')) {
            this.galleryService.DeleteGallery(this.gallery.id, this.gallery.parent_id).subscribe(next => {
                let options = {
                    message: 'Gallery deleted',
                    container: '#editSuccessContainer',
                    duration: 5000
                };
                $.meow(options);
                if (this.gallery.parent_id > 0)
                    this.router.navigate(['/gallery/' + this.gallery.parent_id]);
                else
                    this.router.navigate(['/']);
            });
        }
    }
    ngOnDestroy() {
        this.observer.unsubscribe();
    }
};
GalleryToolbarComponent = tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"]([
    Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Component"])({
        selector: 'gallery-toolbar',
        template: __webpack_require__(/*! raw-loader!./gallery-toolbar.component.html */ "./node_modules/raw-loader/index.js!./src/app/gallery/gallery-toolbar/gallery-toolbar.component.html"),
        styles: [__webpack_require__(/*! ./gallery-toolbar.component.css */ "./src/app/gallery/gallery-toolbar/gallery-toolbar.component.css")]
    }),
    tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"]("design:paramtypes", [_services_data_service__WEBPACK_IMPORTED_MODULE_2__["DataService"],
        _services_button_click_service__WEBPACK_IMPORTED_MODULE_3__["ButtonClickService"],
        _services_gallery_service__WEBPACK_IMPORTED_MODULE_4__["GalleryService"],
        _angular_router__WEBPACK_IMPORTED_MODULE_5__["Router"]])
], GalleryToolbarComponent);



/***/ }),

/***/ "./src/app/home/home-toolbar/home-toolbar.component.css":
/*!**************************************************************!*\
  !*** ./src/app/home/home-toolbar/home-toolbar.component.css ***!
  \**************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = "\n/*# sourceMappingURL=data:application/json;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbXSwibmFtZXMiOltdLCJtYXBwaW5ncyI6IiIsImZpbGUiOiJzcmMvYXBwL2hvbWUvaG9tZS10b29sYmFyL2hvbWUtdG9vbGJhci5jb21wb25lbnQuY3NzIn0= */"

/***/ }),

/***/ "./src/app/home/home-toolbar/home-toolbar.component.ts":
/*!*************************************************************!*\
  !*** ./src/app/home/home-toolbar/home-toolbar.component.ts ***!
  \*************************************************************/
/*! exports provided: HomeToolbarComponent */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "HomeToolbarComponent", function() { return HomeToolbarComponent; });
/* harmony import */ var tslib__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! tslib */ "./node_modules/tslib/tslib.es6.js");
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @angular/core */ "./node_modules/@angular/core/fesm2015/core.js");
/* harmony import */ var _services_data_service__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../services/data.service */ "./src/app/services/data.service.ts");
/* harmony import */ var _services_button_click_service__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../../services/button-click.service */ "./src/app/services/button-click.service.ts");
/* harmony import */ var _services_gallery_service__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ../../services/gallery_service */ "./src/app/services/gallery_service.ts");
/* harmony import */ var _angular_router__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! @angular/router */ "./node_modules/@angular/router/fesm2015/router.js");






let HomeToolbarComponent = class HomeToolbarComponent {
    constructor(dataService, buttonClickService, galleryService, router) {
        this.dataService = dataService;
        this.buttonClickService = buttonClickService;
        this.galleryService = galleryService;
        this.router = router;
        this.gallery = {
            id: 0,
            parent_id: 0,
            name: '',
            description: '',
            tag_list: [],
            parent_gallery: {
                id: 0,
                name: 'Homepage'
            }
        };
        this.observer = dataService.getGalleryObserver().subscribe(data => {
            this.gallery = data;
        });
    }
    onAddGalleryClick() {
        this.buttonClickService.trigger('galleryAddClick');
    }
    ngOnDestroy() {
        this.observer.unsubscribe();
    }
};
HomeToolbarComponent = tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"]([
    Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Component"])({
        selector: 'home-toolbar',
        template: __webpack_require__(/*! raw-loader!./home-toolbar.component.html */ "./node_modules/raw-loader/index.js!./src/app/home/home-toolbar/home-toolbar.component.html"),
        styles: [__webpack_require__(/*! ./home-toolbar.component.css */ "./src/app/home/home-toolbar/home-toolbar.component.css")]
    }),
    tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"]("design:paramtypes", [_services_data_service__WEBPACK_IMPORTED_MODULE_2__["DataService"],
        _services_button_click_service__WEBPACK_IMPORTED_MODULE_3__["ButtonClickService"],
        _services_gallery_service__WEBPACK_IMPORTED_MODULE_4__["GalleryService"],
        _angular_router__WEBPACK_IMPORTED_MODULE_5__["Router"]])
], HomeToolbarComponent);



/***/ }),

/***/ "./src/app/image/image-add/image-add.component.css":
/*!*********************************************************!*\
  !*** ./src/app/image/image-add/image-add.component.css ***!
  \*********************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = ".uploaded-image-list li {\n    padding: 5px 10px;\n}\n\n.uploaded-image-list li img {\n    padding-right: 10px;\n}\n/*# sourceMappingURL=data:application/json;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbInNyYy9hcHAvaW1hZ2UvaW1hZ2UtYWRkL2ltYWdlLWFkZC5jb21wb25lbnQuY3NzIl0sIm5hbWVzIjpbXSwibWFwcGluZ3MiOiJBQUFBO0lBQ0ksaUJBQWlCO0FBQ3JCOztBQUVBO0lBQ0ksbUJBQW1CO0FBQ3ZCIiwiZmlsZSI6InNyYy9hcHAvaW1hZ2UvaW1hZ2UtYWRkL2ltYWdlLWFkZC5jb21wb25lbnQuY3NzIiwic291cmNlc0NvbnRlbnQiOlsiLnVwbG9hZGVkLWltYWdlLWxpc3QgbGkge1xuICAgIHBhZGRpbmc6IDVweCAxMHB4O1xufVxuXG4udXBsb2FkZWQtaW1hZ2UtbGlzdCBsaSBpbWcge1xuICAgIHBhZGRpbmctcmlnaHQ6IDEwcHg7XG59Il19 */"

/***/ }),

/***/ "./src/app/image/image-add/image-add.component.ts":
/*!********************************************************!*\
  !*** ./src/app/image/image-add/image-add.component.ts ***!
  \********************************************************/
/*! exports provided: ImageAddComponent */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "ImageAddComponent", function() { return ImageAddComponent; });
/* harmony import */ var tslib__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! tslib */ "./node_modules/tslib/tslib.es6.js");
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @angular/core */ "./node_modules/@angular/core/fesm2015/core.js");
/* harmony import */ var _services_button_click_service__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../services/button-click.service */ "./src/app/services/button-click.service.ts");
/* harmony import */ var _angular_router__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @angular/router */ "./node_modules/@angular/router/fesm2015/router.js");
/* harmony import */ var _services_image_service__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ../../services/image_service */ "./src/app/services/image_service.ts");





let ImageAddComponent = class ImageAddComponent {
    constructor(buttonClickService, imageService, router) {
        this.buttonClickService = buttonClickService;
        this.imageService = imageService;
        this.router = router;
        this.filename = '';
        this.description = '';
        this.tagList = [];
        this.uploadedFiles = [];
        this.subscription = this.buttonClickService.notifyObservable$.subscribe(data => {
            if (data.name !== 'imageAddClick')
                return;
            this.reset();
            $('#add-modal').modal('show');
            setTimeout(function () {
                $('#inputImageTags').select2({
                    tags: true,
                    ajax: {
                        url: '/api/tag_lookup',
                        dataType: 'json',
                        data: function (params) {
                            return {
                                q: params.term,
                                page: params.page || 1
                            };
                        }
                    }
                });
            }, 0);
        });
    }
    reset() {
        this.description = '';
        this.tagList = [];
        for (let tag of this.gallery.tag_list) {
            this.tagList.push({ name: tag.name, id: '' + tag.id });
        }
    }
    onSubmit() {
        // Select2 isn't synchronising so we have to get the selections manually
        let tagData = $('#inputImageTags').select2('data');
        let tags = [];
        for (let tag of tagData) {
            tags.push(tag.id);
        }
        let files = this.uploadedFiles.map((file) => {
            return file.hash;
        });
        this.imageService.SubmitImages({
            id: 0,
            gallery_id: this.gallery.id,
            description: this.description,
            tags: tags,
            fileHashes: files
        }).subscribe(data => {
            let options = {
                message: 'Image saved',
                container: '#editSuccessContainer',
                duration: 5000
            };
            $.meow(options);
            $('#inputImageTags').children().remove();
            $('#add-modal').modal('hide');
            if (files.length === 1)
                this.router.navigate(['/image/' + this.gallery.id + '/' + data.message]);
        });
    }
    ngOnInit() {
    }
    onUpload(event) {
        let response = JSON.parse(event.xhr.response);
        for (let file of event.files) {
            let hash = '';
            for (let r of response) {
                if (r.filename === file.name)
                    hash = r.hash;
            }
            file.hash = hash;
            this.uploadedFiles.push(file);
        }
    }
    fileDelete($event, file) {
        $event.preventDefault();
        console.log(file);
        let fileIndex = -1;
        for (let { item, index } of this.uploadedFiles.map((item, index) => ({ item, index }))) {
            if (item.hash === file.hash)
                fileIndex = index;
        }
        if (fileIndex > -1)
            this.uploadedFiles.splice(fileIndex, 1);
    }
};
tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"]([
    Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Input"])(),
    tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"]("design:type", Object)
], ImageAddComponent.prototype, "gallery", void 0);
ImageAddComponent = tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"]([
    Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Component"])({
        selector: 'image-add',
        template: __webpack_require__(/*! raw-loader!./image-add.component.html */ "./node_modules/raw-loader/index.js!./src/app/image/image-add/image-add.component.html"),
        styles: [__webpack_require__(/*! ./image-add.component.css */ "./src/app/image/image-add/image-add.component.css")]
    }),
    tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"]("design:paramtypes", [_services_button_click_service__WEBPACK_IMPORTED_MODULE_2__["ButtonClickService"],
        _services_image_service__WEBPACK_IMPORTED_MODULE_4__["ImageService"],
        _angular_router__WEBPACK_IMPORTED_MODULE_3__["Router"]])
], ImageAddComponent);



/***/ }),

/***/ "./src/app/image/image-edit/image-edit.component.css":
/*!***********************************************************!*\
  !*** ./src/app/image/image-edit/image-edit.component.css ***!
  \***********************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = "\n/*# sourceMappingURL=data:application/json;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbXSwibmFtZXMiOltdLCJtYXBwaW5ncyI6IiIsImZpbGUiOiJzcmMvYXBwL2ltYWdlL2ltYWdlLWVkaXQvaW1hZ2UtZWRpdC5jb21wb25lbnQuY3NzIn0= */"

/***/ }),

/***/ "./src/app/image/image-edit/image-edit.component.ts":
/*!**********************************************************!*\
  !*** ./src/app/image/image-edit/image-edit.component.ts ***!
  \**********************************************************/
/*! exports provided: ImageEditComponent */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "ImageEditComponent", function() { return ImageEditComponent; });
/* harmony import */ var tslib__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! tslib */ "./node_modules/tslib/tslib.es6.js");
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @angular/core */ "./node_modules/@angular/core/fesm2015/core.js");
/* harmony import */ var _services_button_click_service__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../services/button-click.service */ "./src/app/services/button-click.service.ts");
/* harmony import */ var _angular_router__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @angular/router */ "./node_modules/@angular/router/fesm2015/router.js");
/* harmony import */ var _services_image_service__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ../../services/image_service */ "./src/app/services/image_service.ts");





let ImageEditComponent = class ImageEditComponent {
    constructor(buttonClickService, imageService, router) {
        this.buttonClickService = buttonClickService;
        this.imageService = imageService;
        this.router = router;
        this.id = '0';
        this.tagList = [];
        this.description = '';
        this.subscription = this.buttonClickService.notifyObservable$.subscribe(data => {
            if (data.name !== 'imageEditClick')
                return;
            this.reset();
            $('#edit-modal').modal('show');
            setTimeout(function () {
                $('#inputImageTags').select2({
                    tags: true,
                    ajax: {
                        url: '/api/tag_lookup',
                        dataType: 'json',
                        data: function (params) {
                            return {
                                q: params.term,
                                page: params.page || 1
                            };
                        }
                    }
                });
            }, 0);
        });
    }
    reset() {
        this.id = '' + this.image.id;
        this.description = this.image.description;
        this.tagList = [];
        let tags = [];
        for (let tag of this.image.tag_list) {
            this.tagList.push({ name: tag.name, id: '' + tag.id });
            tags.push('' + tag.id);
        }
        $('#inputImageTags').val(tags);
    }
    onSubmit() {
        // Select2 isn't synchronising so we have to get the selections manually
        let tagData = $('#inputImageTags').select2('data');
        let tags = [];
        for (let tag of tagData) {
            tags.push(tag.id);
        }
        this.imageService.SubmitImages({
            id: this.image.id,
            gallery_id: this.image.gallery_id,
            description: this.description,
            tags: tags,
        }).subscribe(data => {
            let options = {
                message: 'Image saved',
                container: '#editSuccessContainer',
                duration: 5000
            };
            $.meow(options);
            $('#inputImageTags').children().remove();
            $('#edit-modal').modal('hide');
        });
    }
    ngOnInit() {
    }
};
tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"]([
    Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Input"])(),
    tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"]("design:type", Object)
], ImageEditComponent.prototype, "image", void 0);
ImageEditComponent = tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"]([
    Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Component"])({
        selector: 'image-edit',
        template: __webpack_require__(/*! raw-loader!./image-edit.component.html */ "./node_modules/raw-loader/index.js!./src/app/image/image-edit/image-edit.component.html"),
        styles: [__webpack_require__(/*! ./image-edit.component.css */ "./src/app/image/image-edit/image-edit.component.css")]
    }),
    tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"]("design:paramtypes", [_services_button_click_service__WEBPACK_IMPORTED_MODULE_2__["ButtonClickService"],
        _services_image_service__WEBPACK_IMPORTED_MODULE_4__["ImageService"],
        _angular_router__WEBPACK_IMPORTED_MODULE_3__["Router"]])
], ImageEditComponent);



/***/ }),

/***/ "./src/app/image/image-info/image-info.component.css":
/*!***********************************************************!*\
  !*** ./src/app/image/image-info/image-info.component.css ***!
  \***********************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = ".moa-page {\n    width: 1140px;\n}\n\n.image-container {\n    text-align: center;\n}\n\n.image-lightbox-link {\n    text-align: center;\n    cursor: pointer;\n}\n/*# sourceMappingURL=data:application/json;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbInNyYy9hcHAvaW1hZ2UvaW1hZ2UtaW5mby9pbWFnZS1pbmZvLmNvbXBvbmVudC5jc3MiXSwibmFtZXMiOltdLCJtYXBwaW5ncyI6IkFBQUE7SUFDSSxhQUFhO0FBQ2pCOztBQUVBO0lBQ0ksa0JBQWtCO0FBQ3RCOztBQUVBO0lBQ0ksa0JBQWtCO0lBQ2xCLGVBQWU7QUFDbkIiLCJmaWxlIjoic3JjL2FwcC9pbWFnZS9pbWFnZS1pbmZvL2ltYWdlLWluZm8uY29tcG9uZW50LmNzcyIsInNvdXJjZXNDb250ZW50IjpbIi5tb2EtcGFnZSB7XG4gICAgd2lkdGg6IDExNDBweDtcbn1cblxuLmltYWdlLWNvbnRhaW5lciB7XG4gICAgdGV4dC1hbGlnbjogY2VudGVyO1xufVxuXG4uaW1hZ2UtbGlnaHRib3gtbGluayB7XG4gICAgdGV4dC1hbGlnbjogY2VudGVyO1xuICAgIGN1cnNvcjogcG9pbnRlcjtcbn0iXX0= */"

/***/ }),

/***/ "./src/app/image/image-info/image-info.component.ts":
/*!**********************************************************!*\
  !*** ./src/app/image/image-info/image-info.component.ts ***!
  \**********************************************************/
/*! exports provided: ImageInfoComponent */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "ImageInfoComponent", function() { return ImageInfoComponent; });
/* harmony import */ var tslib__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! tslib */ "./node_modules/tslib/tslib.es6.js");
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @angular/core */ "./node_modules/@angular/core/fesm2015/core.js");
/* harmony import */ var _services_data_service__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../services/data.service */ "./src/app/services/data.service.ts");



let ImageInfoComponent = class ImageInfoComponent {
    constructor(service) {
        this.service = service;
        this.image = {
            id: 0,
            image_src: '',
            description: '',
            format: 'jpg',
            filename: ''
        };
        this.imageFullUrl = this.getFullImageUrl();
        this.observer = service.getImageObserver().subscribe(data => {
            this.image = data;
            this.imageFullUrl = this.getFullImageUrl();
        });
    }
    ngOnDestroy() {
        this.observer.unsubscribe();
    }
    getFullImageUrl() {
        return '/image/' + this.image.id + '/' + this.image.filename;
    }
};
ImageInfoComponent = tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"]([
    Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Component"])({
        selector: 'image-info',
        template: __webpack_require__(/*! raw-loader!./image-info.component.html */ "./node_modules/raw-loader/index.js!./src/app/image/image-info/image-info.component.html"),
        styles: [__webpack_require__(/*! ./image-info.component.css */ "./src/app/image/image-info/image-info.component.css")]
    }),
    tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"]("design:paramtypes", [_services_data_service__WEBPACK_IMPORTED_MODULE_2__["DataService"]])
], ImageInfoComponent);



/***/ }),

/***/ "./src/app/image/image-list/image-list.component.css":
/*!***********************************************************!*\
  !*** ./src/app/image/image-list/image-list.component.css ***!
  \***********************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = ".thumbnail {\n    float: left;\n    margin-bottom: 0;\n}\n/*# sourceMappingURL=data:application/json;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbInNyYy9hcHAvaW1hZ2UvaW1hZ2UtbGlzdC9pbWFnZS1saXN0LmNvbXBvbmVudC5jc3MiXSwibmFtZXMiOltdLCJtYXBwaW5ncyI6IkFBQUE7SUFDSSxXQUFXO0lBQ1gsZ0JBQWdCO0FBQ3BCIiwiZmlsZSI6InNyYy9hcHAvaW1hZ2UvaW1hZ2UtbGlzdC9pbWFnZS1saXN0LmNvbXBvbmVudC5jc3MiLCJzb3VyY2VzQ29udGVudCI6WyIudGh1bWJuYWlsIHtcbiAgICBmbG9hdDogbGVmdDtcbiAgICBtYXJnaW4tYm90dG9tOiAwO1xufSJdfQ== */"

/***/ }),

/***/ "./src/app/image/image-list/image-list.component.ts":
/*!**********************************************************!*\
  !*** ./src/app/image/image-list/image-list.component.ts ***!
  \**********************************************************/
/*! exports provided: ImageListComponent */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "ImageListComponent", function() { return ImageListComponent; });
/* harmony import */ var tslib__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! tslib */ "./node_modules/tslib/tslib.es6.js");
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @angular/core */ "./node_modules/@angular/core/fesm2015/core.js");
/* harmony import */ var _services_data_service__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../services/data.service */ "./src/app/services/data.service.ts");
/* harmony import */ var _services_thumbnail_service__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../../services/thumbnail.service */ "./src/app/services/thumbnail.service.ts");

var ImageListComponent_1;



let ImageListComponent = ImageListComponent_1 = class ImageListComponent {
    constructor(service, thumbService) {
        this.service = service;
        this.thumbService = thumbService;
        this.imagesObserver = service.getImagesObserver().subscribe(data => {
            this.images = data;
            this.checkThumbs();
        });
        this.galleryObserver = service.getGalleryObserver().subscribe(data => {
            this.gallery = data;
        });
    }
    ngOnInit() {
        this.checkThumbs();
    }
    checkThumbs() {
        let imageWidths = [];
        let totalWidth = 0;
        if (this.thumbSub !== undefined)
            this.thumbSub.unsubscribe();
        let toGenerate = [];
        if (this.images !== undefined) {
            for (let image of this.images) {
                if (image.isGenerating) {
                    toGenerate.push(parseInt(image.id));
                }
                let width = image.width * (Number(ImageListComponent_1.TARGET_HEIGHT) / image.height);
                imageWidths.push(width);
                totalWidth += width;
            }
            if (toGenerate.length > 0)
                this.getThumbs(toGenerate);
            let maxWidth = Number(ImageListComponent_1.GALLERY_WIDTH) * 1.2;
            let rows = [];
            let row = {
                width: 0,
                images: 0
            };
            let i = 0;
            while (i < imageWidths.length) {
                row.width += imageWidths[i];
                row.images++;
                if ((row.width > ImageListComponent_1.GALLERY_WIDTH) &&
                    (row.images > 1)) {
                    if (row.width > maxWidth) {
                        row.width -= imageWidths[i];
                        row.images--;
                        rows.push(row);
                        row = {
                            width: imageWidths[i],
                            images: 1
                        };
                    }
                    else {
                        rows.push(row);
                        row = {
                            width: 0,
                            images: 0
                        };
                    }
                }
                i++;
            }
            if ((row.images === 1) &&
                (rows.length > 0)) {
                rows[rows.length - 1].images++;
                rows[rows.length - 1].width += row.width;
                row = {
                    width: 0,
                    images: 0
                };
            }
            if ((row.images > 1) ||
                (rows.length === 0)) {
                rows.push(row);
            }
            i = 0;
            for (let row of rows) {
                let scaleFactor = Number(ImageListComponent_1.GALLERY_WIDTH) / row.width;
                for (let j = 0; j < row.images; j++) {
                    this.images[i].displayWidth = Math.floor(imageWidths[i] * scaleFactor);
                    this.images[i].displayHeight = Math.floor(Number(ImageListComponent_1.TARGET_HEIGHT) * scaleFactor);
                    i++;
                }
            }
        }
    }
    getThumbs(toGenerate) {
        this.thumbSub = this.thumbService.getStatus(toGenerate).subscribe(data => {
            let nextBatch = [];
            for (let image of toGenerate) {
                let found = false;
                for (let notDoneYet of data) {
                    if (image == notDoneYet)
                        found = true;
                }
                if (!found) {
                    for (let i of this.images) {
                        if (image == i.id)
                            i.isGenerating = false;
                    }
                }
                else {
                    nextBatch.push(image);
                }
            }
            this.thumbSub.unsubscribe();
            if (nextBatch.length > 0) {
                setTimeout(() => {
                    this.getThumbs(nextBatch);
                }, 200);
            }
        });
    }
    ngOnDestroy() {
        this.imagesObserver.unsubscribe();
        this.galleryObserver.unsubscribe();
    }
};
ImageListComponent.TARGET_HEIGHT = 300;
ImageListComponent.GALLERY_WIDTH = 1140;
ImageListComponent = ImageListComponent_1 = tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"]([
    Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Component"])({
        selector: 'image-list',
        template: __webpack_require__(/*! raw-loader!./image-list.component.html */ "./node_modules/raw-loader/index.js!./src/app/image/image-list/image-list.component.html"),
        styles: [__webpack_require__(/*! ./image-list.component.css */ "./src/app/image/image-list/image-list.component.css")]
    }),
    tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"]("design:paramtypes", [_services_data_service__WEBPACK_IMPORTED_MODULE_2__["DataService"],
        _services_thumbnail_service__WEBPACK_IMPORTED_MODULE_3__["ThumbnailService"]])
], ImageListComponent);



/***/ }),

/***/ "./src/app/image/image-thumb/image-thumb.component.css":
/*!*************************************************************!*\
  !*** ./src/app/image/image-thumb/image-thumb.component.css ***!
  \*************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = ".thumbnail-generating {\n    width: 64px;\n    height: 64px;\n    margin: 62px 109px;\n}\n\n.thumbnail-image-container {\n    overflow: hidden;\n    text-align: center;\n    background-color: rgba(0, 0, 0, 0.05);\n}\n/*# sourceMappingURL=data:application/json;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbInNyYy9hcHAvaW1hZ2UvaW1hZ2UtdGh1bWIvaW1hZ2UtdGh1bWIuY29tcG9uZW50LmNzcyJdLCJuYW1lcyI6W10sIm1hcHBpbmdzIjoiQUFBQTtJQUNJLFdBQVc7SUFDWCxZQUFZO0lBQ1osa0JBQWtCO0FBQ3RCOztBQUVBO0lBQ0ksZ0JBQWdCO0lBQ2hCLGtCQUFrQjtJQUNsQixxQ0FBcUM7QUFDekMiLCJmaWxlIjoic3JjL2FwcC9pbWFnZS9pbWFnZS10aHVtYi9pbWFnZS10aHVtYi5jb21wb25lbnQuY3NzIiwic291cmNlc0NvbnRlbnQiOlsiLnRodW1ibmFpbC1nZW5lcmF0aW5nIHtcbiAgICB3aWR0aDogNjRweDtcbiAgICBoZWlnaHQ6IDY0cHg7XG4gICAgbWFyZ2luOiA2MnB4IDEwOXB4O1xufVxuXG4udGh1bWJuYWlsLWltYWdlLWNvbnRhaW5lciB7XG4gICAgb3ZlcmZsb3c6IGhpZGRlbjtcbiAgICB0ZXh0LWFsaWduOiBjZW50ZXI7XG4gICAgYmFja2dyb3VuZC1jb2xvcjogcmdiYSgwLCAwLCAwLCAwLjA1KTtcbn0iXX0= */"

/***/ }),

/***/ "./src/app/image/image-thumb/image-thumb.component.ts":
/*!************************************************************!*\
  !*** ./src/app/image/image-thumb/image-thumb.component.ts ***!
  \************************************************************/
/*! exports provided: ImageThumbComponent */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "ImageThumbComponent", function() { return ImageThumbComponent; });
/* harmony import */ var tslib__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! tslib */ "./node_modules/tslib/tslib.es6.js");
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @angular/core */ "./node_modules/@angular/core/fesm2015/core.js");


let ImageThumbComponent = class ImageThumbComponent {
    constructor() { }
    getLink() {
        return '/image/' + this.gallery_id + '/' + this.image.id;
    }
};
tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"]([
    Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Input"])(),
    tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"]("design:type", Object)
], ImageThumbComponent.prototype, "image", void 0);
tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"]([
    Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Input"])(),
    tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"]("design:type", Object)
], ImageThumbComponent.prototype, "gallery_id", void 0);
ImageThumbComponent = tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"]([
    Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Component"])({
        selector: 'image-thumb',
        template: __webpack_require__(/*! raw-loader!./image-thumb.component.html */ "./node_modules/raw-loader/index.js!./src/app/image/image-thumb/image-thumb.component.html"),
        styles: [__webpack_require__(/*! ./image-thumb.component.css */ "./src/app/image/image-thumb/image-thumb.component.css")]
    }),
    tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"]("design:paramtypes", [])
], ImageThumbComponent);



/***/ }),

/***/ "./src/app/image/image-toolbar/image-toolbar.component.css":
/*!*****************************************************************!*\
  !*** ./src/app/image/image-toolbar/image-toolbar.component.css ***!
  \*****************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = "\n/*# sourceMappingURL=data:application/json;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbXSwibmFtZXMiOltdLCJtYXBwaW5ncyI6IiIsImZpbGUiOiJzcmMvYXBwL2ltYWdlL2ltYWdlLXRvb2xiYXIvaW1hZ2UtdG9vbGJhci5jb21wb25lbnQuY3NzIn0= */"

/***/ }),

/***/ "./src/app/image/image-toolbar/image-toolbar.component.ts":
/*!****************************************************************!*\
  !*** ./src/app/image/image-toolbar/image-toolbar.component.ts ***!
  \****************************************************************/
/*! exports provided: ImageToolbarComponent */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "ImageToolbarComponent", function() { return ImageToolbarComponent; });
/* harmony import */ var tslib__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! tslib */ "./node_modules/tslib/tslib.es6.js");
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @angular/core */ "./node_modules/@angular/core/fesm2015/core.js");
/* harmony import */ var _services_button_click_service__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../services/button-click.service */ "./src/app/services/button-click.service.ts");
/* harmony import */ var _services_data_service__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../../services/data.service */ "./src/app/services/data.service.ts");
/* harmony import */ var _angular_router__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! @angular/router */ "./node_modules/@angular/router/fesm2015/router.js");
/* harmony import */ var _services_image_service__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! ../../services/image_service */ "./src/app/services/image_service.ts");






let ImageToolbarComponent = class ImageToolbarComponent {
    constructor(dataService, buttonClickService, imageService, router) {
        this.dataService = dataService;
        this.buttonClickService = buttonClickService;
        this.imageService = imageService;
        this.router = router;
        this.image = {
            id: 0,
            name: '',
            description: '',
            gallery_id: 0
        };
        this.observer = dataService.getImageObserver().subscribe(data => {
            this.image = data;
        });
    }
    onEditClick() {
        this.buttonClickService.trigger('imageEditClick');
    }
    onDeleteClick() {
        if (confirm('Delete this image?')) {
            this.imageService.DeleteImage(this.image.id).subscribe(next => {
                let options = {
                    message: 'Image deleted',
                    container: '#editSuccessContainer',
                    duration: 5000
                };
                $.meow(options);
                this.router.navigate(['/gallery/' + this.image.gallery_id]);
            });
        }
    }
    ngOnDestroy() {
        this.observer.unsubscribe();
    }
};
ImageToolbarComponent = tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"]([
    Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Component"])({
        selector: 'image-toolbar',
        template: __webpack_require__(/*! raw-loader!./image-toolbar.component.html */ "./node_modules/raw-loader/index.js!./src/app/image/image-toolbar/image-toolbar.component.html"),
        styles: [__webpack_require__(/*! ./image-toolbar.component.css */ "./src/app/image/image-toolbar/image-toolbar.component.css")]
    }),
    tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"]("design:paramtypes", [_services_data_service__WEBPACK_IMPORTED_MODULE_3__["DataService"],
        _services_button_click_service__WEBPACK_IMPORTED_MODULE_2__["ButtonClickService"],
        _services_image_service__WEBPACK_IMPORTED_MODULE_5__["ImageService"],
        _angular_router__WEBPACK_IMPORTED_MODULE_4__["Router"]])
], ImageToolbarComponent);



/***/ }),

/***/ "./src/app/models/gallery.model.ts":
/*!*****************************************!*\
  !*** ./src/app/models/gallery.model.ts ***!
  \*****************************************/
/*! exports provided: Gallery */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "Gallery", function() { return Gallery; });
class Gallery {
    constructor(id, name, thumb_id) {
        this.id = id;
        this.name = name;
        this.thumb_id = thumb_id;
    }
}


/***/ }),

/***/ "./src/app/ngbox/ngbox.component.ts":
/*!******************************************!*\
  !*** ./src/app/ngbox/ngbox.component.ts ***!
  \******************************************/
/*! exports provided: NgBoxComponent */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "NgBoxComponent", function() { return NgBoxComponent; });
/* harmony import */ var tslib__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! tslib */ "./node_modules/tslib/tslib.es6.js");
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @angular/core */ "./node_modules/@angular/core/fesm2015/core.js");
/* harmony import */ var _ngbox_service__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./ngbox.service */ "./src/app/ngbox/ngbox.service.ts");



let NgBoxComponent = class NgBoxComponent {
    constructor(ngBox) {
        this.ngBox = ngBox;
        this.showMore = new _angular_core__WEBPACK_IMPORTED_MODULE_1__["EventEmitter"]();
    }
    ngDoCheck() {
        if (this.ngBox.open === true && this.elementView === undefined) {
            this.checkInterval();
        }
    }
    closeOutside($event) {
        if ($event.target.getAttribute('id') === 'ngBoxContent' || $event.target.getAttribute('id') === 'ngBoxWrapper') {
            this.closeNgBox();
        }
    }
    checkInterval() {
        let t = setInterval(() => {
            if (this.elementView && this.elementButtons) {
                this.resize();
                // Stop Loading on frames
                if (this.ngBox.current.type === 2 || this.ngBox.current.type === 3 || this.ngBox.current.type === 4) {
                    this.ngBox.loading = false;
                }
                clearInterval(t);
            }
        }, 10);
    }
    closeNgBox() {
        this.ngBox.open = false;
    }
    elementExist() {
        if (this.elementView !== undefined) {
            return true;
        }
        return false;
    }
    resize() {
        // Resize big images
        if (this.elementView && this.elementButtons) {
            let currentWidth = this.calcPercent(this.ngBox.current.width, window.innerWidth);
            let currentHeight = this.calcPercent(this.ngBox.current.height, window.innerHeight);
            let realWidth = this.elementView.nativeElement.naturalWidth ?
                this.elementView.nativeElement.naturalWidth : currentWidth;
            let realHeight = this.elementView.nativeElement.naturalHeight ?
                this.elementView.nativeElement.naturalHeight : currentHeight;
            let maxWidth = Math.min((window.innerWidth - 70), currentWidth ? currentWidth : realWidth);
            let maxHeight = Math.min((window.innerHeight - 60), currentHeight ? currentHeight : realHeight);
            let ratio = Math.min(maxWidth / realWidth, maxHeight / realHeight);
            this.elementView.nativeElement.width = realWidth * ratio;
            this.elementView.nativeElement.height = realHeight * ratio;
            this.elementButtons.nativeElement.style.width = this.elementView.nativeElement.offsetWidth + 'px';
            // Calculate top padding
            this.offsetHeight = (window.innerHeight - 40 - this.elementView.nativeElement.offsetHeight) / 2;
            if (this.offsetHeight < 0) {
                this.offsetHeight = 0;
            }
        }
    }
    checkKeyPress(event) {
        if (event.keyCode === 39) {
            this.nextNgBox();
        }
        else if (event.keyCode === 37) {
            this.previousNgBox();
        }
        else if (event.keyCode === 27) {
            this.closeNgBox();
        }
    }
    calcPercent(value, of) {
        if (value !== undefined && value.toString().search('%') >= 0) {
            return of * parseInt(value.toString(), 0) / 100;
        }
        return value;
    }
    getHasGroup() {
        return this.ngBox.current.group !== undefined;
    }
    getCount() {
        return this.ngBox.images.filter(image => image.group === this.ngBox.current.group).length;
    }
    getCurrentIndex() {
        let currentGroup = this.ngBox.images.filter(image => image.group === this.ngBox.current.group);
        return currentGroup.map(function (e) {
            return e.id;
        }).indexOf(this.ngBox.current.id) + 1;
    }
    nextNgBox() {
        if (this.ngBox.current.group === undefined) {
            return false;
        }
        this.ngBox.loading = true;
        let currentGroup = this.ngBox.images.filter(image => image.group === this.ngBox.current.group);
        let pos = currentGroup.map(function (e) {
            return e.id;
        }).indexOf(this.ngBox.current.id);
        if (pos >= currentGroup.length - 1) {
            this.ngBox.current = currentGroup[0];
        }
        else {
            this.ngBox.current = currentGroup[pos + 1];
        }
        this.checkInterval();
    }
    previousNgBox() {
        if (this.ngBox.current.group === undefined) {
            return false;
        }
        this.ngBox.loading = true;
        let currentGroup = this.ngBox.images.filter(image => image.group === this.ngBox.current.group);
        let pos = currentGroup.map(function (e) {
            return e.id;
        }).indexOf(this.ngBox.current.id);
        if (pos === 0) {
            pos = currentGroup.length;
        }
        this.ngBox.current = currentGroup[pos - 1];
        this.checkInterval();
    }
    isLoaded() {
        if (this.ngBox.current.type === 1) {
            this.ngBox.loading = false;
        }
        this.checkInterval();
    }
};
tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"]([
    Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Input"])(),
    tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"]("design:type", Object)
], NgBoxComponent.prototype, "data", void 0);
tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"]([
    Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Output"])(),
    tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"]("design:type", Object)
], NgBoxComponent.prototype, "showMore", void 0);
tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"]([
    Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["ViewChild"])('ngBoxContent', null),
    tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"]("design:type", _angular_core__WEBPACK_IMPORTED_MODULE_1__["ElementRef"])
], NgBoxComponent.prototype, "elementView", void 0);
tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"]([
    Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["ViewChild"])('ngBoxButtons', null),
    tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"]("design:type", _angular_core__WEBPACK_IMPORTED_MODULE_1__["ElementRef"])
], NgBoxComponent.prototype, "elementButtons", void 0);
tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"]([
    Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["HostListener"])('window:resize', ['$event']),
    tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"]("design:type", Function),
    tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"]("design:paramtypes", []),
    tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"]("design:returntype", void 0)
], NgBoxComponent.prototype, "resize", null);
tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"]([
    Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["HostListener"])('window:keydown', ['$event']),
    tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"]("design:type", Function),
    tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"]("design:paramtypes", [KeyboardEvent]),
    tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"]("design:returntype", void 0)
], NgBoxComponent.prototype, "checkKeyPress", null);
NgBoxComponent = tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"]([
    Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Component"])({
        selector: 'my-ngbox, ngbox',
        template: `
        <div id="ngBoxLoading" *ngIf="ngBox.loading"><img src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNv
ZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9Im5vIj8+PHN2ZyB4bWxuczpzdmc9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxucz0iaHR0cD
ovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB2ZXJzaW9uPSIxLjAiIHdpZHRo
PSIxNjBweCIgaGVpZ2h0PSIyMHB4IiB2aWV3Qm94PSIwIDAgMTI4IDE2IiB4bWw6c3BhY2U9InByZXNlcnZlIj48c2NyaXB0IHR5cGU9InRleHQvZW
NtYXNjcmlwdCIgeGxpbms6aHJlZj0iLy9wcmVsb2FkZXJzLm5ldC9qc2NyaXB0cy9zbWlsLnVzZXIuanMiLz48cGF0aCBmaWxsPSIjZmZmZmZmIiBm
aWxsLW9wYWNpdHk9IjAuNDE5NjA3ODQzMTM3MjUiIGQ9Ik02LjQsNC44QTMuMiwzLjIsMCwxLDEsMy4yLDgsMy4yLDMuMiwwLDAsMSw2LjQsNC44Wm
0xMi44LDBBMy4yLDMuMiwwLDEsMSwxNiw4LDMuMiwzLjIsMCwwLDEsMTkuMiw0LjhaTTMyLDQuOEEzLjIsMy4yLDAsMSwxLDI4LjgsOCwzLjIsMy4y
LDAsMCwxLDMyLDQuOFptMTIuOCwwQTMuMiwzLjIsMCwxLDEsNDEuNiw4LDMuMiwzLjIsMCwwLDEsNDQuOCw0LjhabTEyLjgsMEEzLjIsMy4yLDAsMS
wxLDU0LjQsOCwzLjIsMy4yLDAsMCwxLDU3LjYsNC44Wm0xMi44LDBBMy4yLDMuMiwwLDEsMSw2Ny4yLDgsMy4yLDMuMiwwLDAsMSw3MC40LDQuOFpt
MTIuOCwwQTMuMiwzLjIsMCwxLDEsODAsOCwzLjIsMy4yLDAsMCwxLDgzLjIsNC44Wk05Niw0LjhBMy4yLDMuMiwwLDEsMSw5Mi44LDgsMy4yLDMuMi
wwLDAsMSw5Niw0LjhabTEyLjgsMEEzLjIsMy4yLDAsMSwxLDEwNS42LDgsMy4yLDMuMiwwLDAsMSwxMDguOCw0LjhabTEyLjgsMEEzLjIsMy4yLDAs
MSwxLDExOC40LDgsMy4yLDMuMiwwLDAsMSwxMjEuNiw0LjhaIi8+PGc+PHBhdGggZmlsbD0iI2ZmZmZmZiIgZmlsbC1vcGFjaXR5PSIxIiBkPSJNLT
QyLjcsMy44NEE0LjE2LDQuMTYsMCwwLDEtMzguNTQsOGE0LjE2LDQuMTYsMCwwLDEtNC4xNiw0LjE2QTQuMTYsNC4xNiwwLDAsMS00Ni44Niw4LDQu
MTYsNC4xNiwwLDAsMS00Mi43LDMuODRabTEyLjgtLjY0QTQuOCw0LjgsMCwwLDEtMjUuMSw4YTQuOCw0LjgsMCwwLDEtNC44LDQuOEE0LjgsNC44LD
AsMCwxLTM0LjcsOCw0LjgsNC44LDAsMCwxLTI5LjksMy4yWm0xMi44LS42NEE1LjQ0LDUuNDQsMCwwLDEtMTEuNjYsOGE1LjQ0LDUuNDQsMCwwLDEt
NS40NCw1LjQ0QTUuNDQsNS40NCwwLDAsMS0yMi41NCw4LDUuNDQsNS40NCwwLDAsMS0xNy4xLDIuNTZaIi8+PGFuaW1hdGVUcmFuc2Zvcm0gYXR0cm
lidXRlTmFtZT0idHJhbnNmb3JtIiB0eXBlPSJ0cmFuc2xhdGUiIHZhbHVlcz0iMjMgMDszNiAwOzQ5IDA7NjIgMDs3NC41IDA7ODcuNSAwOzEwMCAw
OzExMyAwOzEyNS41IDA7MTM4LjUgMDsxNTEuNSAwOzE2NC41IDA7MTc4IDAiIGNhbGNNb2RlPSJkaXNjcmV0ZSIgZHVyPSI3ODBtcyIgcmVwZWF0Q2
91bnQ9ImluZGVmaW5pdGUiLz48L2c+PC9zdmc+Cg=="/></div>
        <div id="ngBoxWrapper" (click)="closeOutside($event)" *ngIf="ngBox.open" [ngStyle]="{'padding-top': offsetHeight+'px'}">
            <div id="ngBoxContent">
                <img *ngIf="getHasGroup()" class="left" (click)="previousNgBox()" src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvb
j0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz4NCjwhLS0gR2VuZXJhdG9yOiBBZG9iZSBJbGx1c3RyYXRvciAxNS4xLjAsIFNWRyBFeHBvcnQgUGx1Zy1JbiAuIFNWRyB
WZXJzaW9uOiA2LjAwIEJ1aWxkIDApICAtLT4NCjwhRE9DVFlQRSBzdmcgUFVCTElDICItLy9XM0MvL0RURCBTVkcgMS4xLy9FTiIgImh0dHA6Ly93d3cudzMub3JnL
0dyYXBoaWNzL1NWRy8xLjEvRFREL3N2ZzExLmR0ZCI+DQo8c3ZnIHZlcnNpb249IjEuMSIgaWQ9IkxheWVyXzEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDA
wL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHg9IjBweCIgeT0iMHB4Ig0KCSB3aWR0aD0iNzBweCIgaGVpZ2h0PSIxMDBwe
CIgdmlld0JveD0iMCAwIDcwIDEwMCIgZW5hYmxlLWJhY2tncm91bmQ9Im5ldyAwIDAgNzAgMTAwIiB4bWw6c3BhY2U9InByZXNlcnZlIj4NCjxwb2x5Z29uIGZpbGw
9IiNGRkZGRkYiIHN0cm9rZT0iIzZCNkI2QiIgc3Ryb2tlLW1pdGVybGltaXQ9IjEwIiBwb2ludHM9IjQ1LjYsOTguNTI0IDE0LjU0NCw1MCA0NS42LDEuNDc2IDQ4L
jgwMSwzLjUyNCAxOS4wNTYsNTAgDQoJNDguODAxLDk2LjQ3NiAiLz4NCjwvc3ZnPg0K">
                <img *ngIf="getHasGroup()" class="right" (click)="nextNgBox()" src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0i
MS4wIiBlbmNvZGluZz0idXRmLTgiPz4NCjwhLS0gR2VuZXJhdG9yOiBBZG9iZSBJbGx1c3RyYXRvciAxNS4xLjAsIFNWRyBFeHBvcnQgUGx1Zy1JbiAuIFNWRyBWZX
JzaW9uOiA2LjAwIEJ1aWxkIDApICAtLT4NCjwhRE9DVFlQRSBzdmcgUFVCTElDICItLy9XM0MvL0RURCBTVkcgMS4xLy9FTiIgImh0dHA6Ly93d3cudzMub3JnL0dy
YXBoaWNzL1NWRy8xLjEvRFREL3N2ZzExLmR0ZCI+DQo8c3ZnIHZlcnNpb249IjEuMSIgaWQ9IkxheWVyXzEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3
N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHg9IjBweCIgeT0iMHB4Ig0KCSB3aWR0aD0iNzBweCIgaGVpZ2h0PSIxMDBweCIg
dmlld0JveD0iMCAwIDcwIDEwMCIgZW5hYmxlLWJhY2tncm91bmQ9Im5ldyAwIDAgNzAgMTAwIiB4bWw6c3BhY2U9InByZXNlcnZlIj4NCjxwb2x5Z29uIGZpbGw9Ii
NGRkZGRkYiIHN0cm9rZT0iIzZCNkI2QiIgc3Ryb2tlLW1pdGVybGltaXQ9IjEwIiBwb2ludHM9IjE3Ljc0Niw5OC41MjQgNDguODAxLDUwIDE3Ljc0NiwxLjQ3NiAx
NC41NDUsMy41MjQgDQoJNDQuMjg5LDUwIDE0LjU0NSw5Ni40NzYgIi8+DQo8L3N2Zz4NCg==">
                <img *ngIf="ngBox.current.type == 1"
                     (load)="isLoaded()" 
                     #ngBoxContent 
                     [src]="ngBox.current.url"
                     [hidden]="ngBox.loading" 
                     (click)="nextNgBox()"
                     alt="">
                <iframe *ngIf="ngBox.current.type == 2" 
                        #ngBoxContent
                        [src]="ngBox.current.url"
                        width="{{ngBox.current.width}}"
                        height="{{ngBox.current.height}}"
                        frameborder="0"
                        allowfullscreen>
                </iframe>
                <iframe *ngIf="ngBox.current.type == 3" 
                        [src]="ngBox.current.url"
                        #ngBoxContent
                        width="{{ngBox.current.width}}"
                        height="{{ngBox.current.height}}"
                        frameborder="0" 
                        webkitallowfullscreen 
                        mozallowfullscreen 
                        allowfullscreen>
                </iframe>
                <iframe *ngIf="ngBox.current.type == 4" 
                        #ngBoxContent
                        [src]="ngBox.current.url"
                        frameborder="0"
                        width="{{ngBox.current.width}}"
                        height="{{ngBox.current.height}}"
                        allowfullscreen>
                </iframe>
            </div>
            <div #ngBoxButtons id="buttons" [hidden]="ngBox.loading">
                <p>
                    <span class="title" *ngIf="ngBox.current.title">{{ngBox.current.title}}<br/></span>
                    <span class="pages" *ngIf="getHasGroup()">{{getCurrentIndex()}} of {{getCount()}}</span>
                </p>
                <img (click)="closeNgBox()" id="closeButton" src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZG
luZz0idXRmLTgiPz4NCjwhLS0gR2VuZXJhdG9yOiBBZG9iZSBJbGx1c3RyYXRvciAxNS4xLjAsIFNWRyBFeHBvcnQgUGx1Zy1JbiAuIFNWRyBWZXJzaW9uOiA2LjAw
IEJ1aWxkIDApICAtLT4NCjwhRE9DVFlQRSBzdmcgUFVCTElDICItLy9XM0MvL0RURCBTVkcgMS4xLy9FTiIgImh0dHA6Ly93d3cudzMub3JnL0dyYXBoaWNzL1NWRy
8xLjEvRFREL3N2ZzExLmR0ZCI+DQo8c3ZnIHZlcnNpb249IjEuMSIgaWQ9IkxheWVyXzEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6
eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHg9IjBweCIgeT0iMHB4Ig0KCSB3aWR0aD0iMzBweCIgaGVpZ2h0PSIzMHB4IiB2aWV3Qm94PSIwID
AgMzAgMzAiIGVuYWJsZS1iYWNrZ3JvdW5kPSJuZXcgMCAwIDMwIDMwIiB4bWw6c3BhY2U9InByZXNlcnZlIj4NCjxwb2x5Z29uIGZpbGw9IiNGRkZGRkYiIHN0cm9r
ZT0iIzZCNkI2QiIgc3Ryb2tlLW1pdGVybGltaXQ9IjEwIiBwb2ludHM9IjI4LjUsMi44NCAyNS40NjMsMS41IDE1LDEyLjc0OSA0LjUzOSwxLjUgMS41LDIuODQgDQ
oJMTIuODExLDE1IDEuNSwyNy4xNiA0LjUzOSwyOC41IDE1LDE3LjI1MSAyNS40NjMsMjguNSAyOC41LDI3LjE2IDE3LjE4OSwxNSAiLz4NCjwvc3ZnPg0K" alt="">
            </div>


            
            
            

        </div>
    `,
        styles: ["\n        #ngBoxLoading{\n            text-align: center;\n            z-index: 10001;\n            width: 100%;\n            height: 100%;\n            color: white;\n            position: fixed;\n            top: 46%;\n            font-size: 20px;\n        }\n        #ngBoxWrapper {\n            background-color: rgba(0, 0, 0, 0.9);\n            position: fixed;\n            top: 0px;\n            left: 0px;\n            text-align: center;\n            z-index: 10000;\n            width: 100%;\n            height: 100%;\n        }\n\n        #ngBoxWrapper #ngBoxContent img {\n            -webkit-border-radius: 4px;\n            -moz-border-radius: 4px;\n            border-radius: 4px;\n        }\n\n        #ngBoxContent {\n            display: block;\n        }\n\n        button {\n            font-size: 12px;\n        }\n\n        iframe {\n            max-width: 100%;\n            max-height: 100%;\n        }\n        #buttons{\n            position: relative;\n            margin: 5px auto;\n            text-align: right;\n        }\n        #buttons p{\n            float: left;\n            color: white;\n            text-align: left;\n            margin: 0 50px 0 0;\n            font-size: 12px;\n            font-family: sans-serif;\n        }\n        #buttons span.title{\n            display: block;\n            height: 18px;\n            overflow: hidden;\n        }\n        #closeButton{\n            position: absolute;\n            top: 0px;\n            right: 0px;\n            cursor: pointer;\n        }\n        .left{\n            position: fixed;\n            left: -5px;\n            margin-top: -42px;\n            cursor: pointer;\n            top: 50%;\n        }\n        .right{\n            position: fixed;\n            right: -10px;\n            margin-top: -42px;\n            cursor: pointer;\n            top: 50%;\n        }\n    "]
    }),
    tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"]("design:paramtypes", [_ngbox_service__WEBPACK_IMPORTED_MODULE_2__["NgBoxService"]])
], NgBoxComponent);



/***/ }),

/***/ "./src/app/ngbox/ngbox.directive.ts":
/*!******************************************!*\
  !*** ./src/app/ngbox/ngbox.directive.ts ***!
  \******************************************/
/*! exports provided: NgBoxDirective */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "NgBoxDirective", function() { return NgBoxDirective; });
/* harmony import */ var tslib__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! tslib */ "./node_modules/tslib/tslib.es6.js");
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @angular/core */ "./node_modules/@angular/core/fesm2015/core.js");
/* harmony import */ var _angular_platform_browser__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @angular/platform-browser */ "./node_modules/@angular/platform-browser/fesm2015/platform-browser.js");
/* harmony import */ var _ngbox_service__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./ngbox.service */ "./src/app/ngbox/ngbox.service.ts");




let NgBoxDirective = class NgBoxDirective {
    constructor(ngBox, sanitizer) {
        this.ngBox = ngBox;
        this.sanitizer = sanitizer;
    }
    ngOnDestroy() {
        this.removeImage();
    }
    ngAfterViewInit() {
        this.ngBox.id = this.id = this.ngBox.id + 1;
        this.updateImage();
    }
    removeImage() {
        let pos = this.ngBox.images.map(function (e) { return e.id; }).indexOf(this.id);
        if (pos !== -1)
            this.ngBox.images.splice(pos, 1);
    }
    updateImage() {
        let src = this.src ? this.src : this.href;
        this.data = this.getData(src);
        this.ngBox.images.push(this.data);
    }
    onClick($event) {
        $event.preventDefault();
        this.removeImage();
        this.updateImage();
        this.ngBox.loading = true;
        this.ngBox.current = this.data;
        this.ngBox.open = true;
    }
    getData(url) {
        if (url !== undefined || url !== '') {
            // Youtube
            let regExp = /^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|\&v=|\?v=)([^#\&\?]*).*/;
            let match = url.match(regExp);
            if (match && match[2].length === 11) {
                return {
                    id: this.id,
                    url: this.sanitizer.bypassSecurityTrustResourceUrl('https://www.youtube.com/embed/' + match[2] + '?autoplay=0'),
                    type: 2,
                    title: this.title,
                    width: this.width ? this.width : 640,
                    height: this.height ? this.height : 380,
                    group: this.group
                };
            }
            // Vimeo
            regExp = /^.*(vimeo\.com\/)((channels\/[A-z]+\/)|(groups\/[A-z]+\/videos\/))?([0-9]+)/;
            match = url.match(regExp);
            if (match && match[5].length === 8) {
                return {
                    id: this.id,
                    url: this.sanitizer.bypassSecurityTrustResourceUrl('https://player.vimeo.com/video/' + match[5]),
                    type: 3,
                    title: this.title,
                    width: this.width ? this.width : 640,
                    height: this.height ? this.height : 380,
                    group: this.group
                };
            }
            if (!url.match(/\.(png|jpg|jpeg|gif|JPG|PNG|JPEG|GIF)$/) && this.image !== true) {
                return {
                    id: this.id,
                    url: this.sanitizer.bypassSecurityTrustResourceUrl(url),
                    type: 4,
                    title: this.title,
                    width: this.width ? this.width : 1000,
                    height: this.height ? this.height : 480,
                    group: this.group
                };
            }
            /*            if (url.search('photoshooter') >= 0 || url.search('news247') >= 0) {
                            return {
                                id: this.id,
                                url: this.sanitizer.bypassSecurityTrustResourceUrl(url),
                                type: 4,
                                title: this.title,
                                width: this.width ? this.width : 1000,
                                height: this.height ? this.height : 480,
                                group: this.group
                            };
                        }*/
            if (this.cache) {
                (new Image()).src = url;
            }
            return {
                id: this.id,
                url: url,
                type: 1,
                title: this.title,
                width: this.width,
                height: this.height,
                group: this.group
            };
        }
    }
};
tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"]([
    Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Input"])(),
    tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"]("design:type", Object)
], NgBoxDirective.prototype, "src", void 0);
tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"]([
    Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Input"])(),
    tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"]("design:type", Object)
], NgBoxDirective.prototype, "href", void 0);
tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"]([
    Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Input"])(),
    tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"]("design:type", String)
], NgBoxDirective.prototype, "title", void 0);
tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"]([
    Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Input"])(),
    tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"]("design:type", String)
], NgBoxDirective.prototype, "width", void 0);
tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"]([
    Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Input"])(),
    tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"]("design:type", String)
], NgBoxDirective.prototype, "height", void 0);
tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"]([
    Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Input"])(),
    tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"]("design:type", String)
], NgBoxDirective.prototype, "group", void 0);
tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"]([
    Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Input"])(),
    tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"]("design:type", Boolean)
], NgBoxDirective.prototype, "cache", void 0);
tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"]([
    Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Input"])(),
    tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"]("design:type", Boolean)
], NgBoxDirective.prototype, "image", void 0);
tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"]([
    Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["HostListener"])('click', ['$event']),
    tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"]("design:type", Function),
    tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"]("design:paramtypes", [Object]),
    tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"]("design:returntype", void 0)
], NgBoxDirective.prototype, "onClick", null);
NgBoxDirective = tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"]([
    Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Directive"])({
        selector: '[myNgBox],[ng-box]'
    }),
    tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"]("design:paramtypes", [_ngbox_service__WEBPACK_IMPORTED_MODULE_3__["NgBoxService"],
        _angular_platform_browser__WEBPACK_IMPORTED_MODULE_2__["DomSanitizer"]])
], NgBoxDirective);



/***/ }),

/***/ "./src/app/ngbox/ngbox.service.ts":
/*!****************************************!*\
  !*** ./src/app/ngbox/ngbox.service.ts ***!
  \****************************************/
/*! exports provided: NgBoxService */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "NgBoxService", function() { return NgBoxService; });
/* harmony import */ var tslib__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! tslib */ "./node_modules/tslib/tslib.es6.js");
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @angular/core */ "./node_modules/@angular/core/fesm2015/core.js");


let NgBoxService = class NgBoxService {
    constructor() {
        this.id = 0;
        this.loading = false;
        this.open = false;
        this.images = [];
    }
};
NgBoxService = tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"]([
    Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Injectable"])(),
    tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"]("design:paramtypes", [])
], NgBoxService);



/***/ }),

/***/ "./src/app/pages/gallery-page/gallery-page.component.css":
/*!***************************************************************!*\
  !*** ./src/app/pages/gallery-page/gallery-page.component.css ***!
  \***************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = "\n/*# sourceMappingURL=data:application/json;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbXSwibmFtZXMiOltdLCJtYXBwaW5ncyI6IiIsImZpbGUiOiJzcmMvYXBwL3BhZ2VzL2dhbGxlcnktcGFnZS9nYWxsZXJ5LXBhZ2UuY29tcG9uZW50LmNzcyJ9 */"

/***/ }),

/***/ "./src/app/pages/gallery-page/gallery-page.component.ts":
/*!**************************************************************!*\
  !*** ./src/app/pages/gallery-page/gallery-page.component.ts ***!
  \**************************************************************/
/*! exports provided: GalleryPageComponent */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "GalleryPageComponent", function() { return GalleryPageComponent; });
/* harmony import */ var tslib__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! tslib */ "./node_modules/tslib/tslib.es6.js");
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @angular/core */ "./node_modules/@angular/core/fesm2015/core.js");
/* harmony import */ var _angular_router__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @angular/router */ "./node_modules/@angular/router/fesm2015/router.js");
/* harmony import */ var _services_page_data_service__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../../services/page_data.service */ "./src/app/services/page_data.service.ts");




let GalleryPageComponent = class GalleryPageComponent {
    constructor(route, page_data_service) {
        this.route = route;
        this.page_data_service = page_data_service;
    }
    ngOnInit() {
        this.route.params.subscribe(params => {
            this.page_data_service.GetGalleryPageData(params['id']);
        });
    }
};
GalleryPageComponent = tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"]([
    Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Component"])({
        selector: 'gallery-page',
        template: __webpack_require__(/*! raw-loader!./gallery-page.component.html */ "./node_modules/raw-loader/index.js!./src/app/pages/gallery-page/gallery-page.component.html"),
        styles: [__webpack_require__(/*! ./gallery-page.component.css */ "./src/app/pages/gallery-page/gallery-page.component.css")]
    }),
    tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"]("design:paramtypes", [_angular_router__WEBPACK_IMPORTED_MODULE_2__["ActivatedRoute"],
        _services_page_data_service__WEBPACK_IMPORTED_MODULE_3__["PageDataService"]])
], GalleryPageComponent);



/***/ }),

/***/ "./src/app/pages/home-page/home-page.component.css":
/*!*********************************************************!*\
  !*** ./src/app/pages/home-page/home-page.component.css ***!
  \*********************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = "\n/*# sourceMappingURL=data:application/json;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbXSwibmFtZXMiOltdLCJtYXBwaW5ncyI6IiIsImZpbGUiOiJzcmMvYXBwL3BhZ2VzL2hvbWUtcGFnZS9ob21lLXBhZ2UuY29tcG9uZW50LmNzcyJ9 */"

/***/ }),

/***/ "./src/app/pages/home-page/home-page.component.ts":
/*!********************************************************!*\
  !*** ./src/app/pages/home-page/home-page.component.ts ***!
  \********************************************************/
/*! exports provided: HomePageComponent */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "HomePageComponent", function() { return HomePageComponent; });
/* harmony import */ var tslib__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! tslib */ "./node_modules/tslib/tslib.es6.js");
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @angular/core */ "./node_modules/@angular/core/fesm2015/core.js");
/* harmony import */ var _services_page_data_service__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../services/page_data.service */ "./src/app/services/page_data.service.ts");



let HomePageComponent = class HomePageComponent {
    constructor(page_data_service) {
        this.page_data_service = page_data_service;
    }
    ngOnInit() {
        this.page_data_service.GetHomePageData();
    }
};
HomePageComponent = tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"]([
    Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Component"])({
        selector: 'moa',
        template: __webpack_require__(/*! raw-loader!./home-page.component.html */ "./node_modules/raw-loader/index.js!./src/app/pages/home-page/home-page.component.html"),
        styles: [__webpack_require__(/*! ./home-page.component.css */ "./src/app/pages/home-page/home-page.component.css")]
    }),
    tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"]("design:paramtypes", [_services_page_data_service__WEBPACK_IMPORTED_MODULE_2__["PageDataService"]])
], HomePageComponent);



/***/ }),

/***/ "./src/app/pages/image-page/image-page.component.css":
/*!***********************************************************!*\
  !*** ./src/app/pages/image-page/image-page.component.css ***!
  \***********************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = "\n/*# sourceMappingURL=data:application/json;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbXSwibmFtZXMiOltdLCJtYXBwaW5ncyI6IiIsImZpbGUiOiJzcmMvYXBwL3BhZ2VzL2ltYWdlLXBhZ2UvaW1hZ2UtcGFnZS5jb21wb25lbnQuY3NzIn0= */"

/***/ }),

/***/ "./src/app/pages/image-page/image-page.component.ts":
/*!**********************************************************!*\
  !*** ./src/app/pages/image-page/image-page.component.ts ***!
  \**********************************************************/
/*! exports provided: ImagePageComponent */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "ImagePageComponent", function() { return ImagePageComponent; });
/* harmony import */ var tslib__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! tslib */ "./node_modules/tslib/tslib.es6.js");
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @angular/core */ "./node_modules/@angular/core/fesm2015/core.js");
/* harmony import */ var _angular_router__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @angular/router */ "./node_modules/@angular/router/fesm2015/router.js");
/* harmony import */ var _services_page_data_service__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../../services/page_data.service */ "./src/app/services/page_data.service.ts");




let ImagePageComponent = class ImagePageComponent {
    constructor(route, page_data_service) {
        this.route = route;
        this.page_data_service = page_data_service;
    }
    ngOnInit() {
        this.route.params.subscribe(params => {
            this.page_data_service.GetImagePageData(params['image_id'], params['gallery_id']);
        });
    }
};
ImagePageComponent = tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"]([
    Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Component"])({
        selector: 'image-page',
        template: __webpack_require__(/*! raw-loader!./image-page.component.html */ "./node_modules/raw-loader/index.js!./src/app/pages/image-page/image-page.component.html"),
        styles: [__webpack_require__(/*! ./image-page.component.css */ "./src/app/pages/image-page/image-page.component.css")]
    }),
    tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"]("design:paramtypes", [_angular_router__WEBPACK_IMPORTED_MODULE_2__["ActivatedRoute"],
        _services_page_data_service__WEBPACK_IMPORTED_MODULE_3__["PageDataService"]])
], ImagePageComponent);



/***/ }),

/***/ "./src/app/services/button-click.service.ts":
/*!**************************************************!*\
  !*** ./src/app/services/button-click.service.ts ***!
  \**************************************************/
/*! exports provided: ButtonClickService */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "ButtonClickService", function() { return ButtonClickService; });
/* harmony import */ var tslib__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! tslib */ "./node_modules/tslib/tslib.es6.js");
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @angular/core */ "./node_modules/@angular/core/fesm2015/core.js");
/* harmony import */ var rxjs_Subject__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! rxjs/Subject */ "./node_modules/rxjs-compat/_esm2015/Subject.js");



let ButtonClickService = class ButtonClickService {
    constructor() {
        this.notify = new rxjs_Subject__WEBPACK_IMPORTED_MODULE_2__["Subject"]();
        this.notifyObservable$ = this.notify.asObservable();
    }
    trigger(name, data = null) {
        if (name) {
            this.notify.next({
                name: name,
                data: data
            });
        }
    }
};
ButtonClickService = tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"]([
    Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Injectable"])(),
    tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"]("design:paramtypes", [])
], ButtonClickService);



/***/ }),

/***/ "./src/app/services/data.service.ts":
/*!******************************************!*\
  !*** ./src/app/services/data.service.ts ***!
  \******************************************/
/*! exports provided: DataService */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "DataService", function() { return DataService; });
/* harmony import */ var tslib__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! tslib */ "./node_modules/tslib/tslib.es6.js");
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @angular/core */ "./node_modules/@angular/core/fesm2015/core.js");
/* harmony import */ var _angular_common_http__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @angular/common/http */ "./node_modules/@angular/common/fesm2015/http.js");
/* harmony import */ var rxjs_BehaviorSubject__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! rxjs/BehaviorSubject */ "./node_modules/rxjs-compat/_esm2015/BehaviorSubject.js");
/* harmony import */ var rxjs_add_operator_map__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! rxjs/add/operator/map */ "./node_modules/rxjs-compat/_esm2015/add/operator/map.js");
/* harmony import */ var rxjs_add_operator_filter__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! rxjs/add/operator/filter */ "./node_modules/rxjs-compat/_esm2015/add/operator/filter.js");






let DataService = class DataService {
    constructor(http) {
        this.http = http;
        this.data = new rxjs_BehaviorSubject__WEBPACK_IMPORTED_MODULE_3__["BehaviorSubject"]([]);
    }
    setPageData(pageData) {
        this.data.next(pageData);
    }
    getBreadcrumbObserver() {
        return this.data
            .map(data => {
            return data.breadcrumbs;
        })
            .filter(data => data !== undefined);
    }
    getGalleriesObserver() {
        return this.data
            .map(data => {
            return data.galleries;
        })
            .filter(data => data !== undefined);
    }
    getGalleryObserver() {
        return this.data
            .map(data => {
            // TODO: Convert to Gallery model?
            return data.gallery;
        })
            .filter(data => data !== undefined);
    }
    getImageObserver() {
        return this.data
            .map(data => {
            // TODO: Convert to Image model?
            return data.image;
        })
            .filter(data => data !== undefined);
    }
    getImagesObserver() {
        return this.data
            .map(data => {
            return data.images;
        })
            .filter(data => data !== undefined);
    }
    getPageTitleObserver() {
        return this.data
            .map(data => {
            return data.page_title;
        })
            .filter(data => data !== undefined);
    }
};
DataService = tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"]([
    Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Injectable"])(),
    tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"]("design:paramtypes", [_angular_common_http__WEBPACK_IMPORTED_MODULE_2__["HttpClient"]])
], DataService);



/***/ }),

/***/ "./src/app/services/gallery_service.ts":
/*!*********************************************!*\
  !*** ./src/app/services/gallery_service.ts ***!
  \*********************************************/
/*! exports provided: GalleryService */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "GalleryService", function() { return GalleryService; });
/* harmony import */ var tslib__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! tslib */ "./node_modules/tslib/tslib.es6.js");
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @angular/core */ "./node_modules/@angular/core/fesm2015/core.js");
/* harmony import */ var _data_service__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./data.service */ "./src/app/services/data.service.ts");
/* harmony import */ var _angular_common_http__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @angular/common/http */ "./node_modules/@angular/common/fesm2015/http.js");
/* harmony import */ var rxjs_Subject__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! rxjs/Subject */ "./node_modules/rxjs-compat/_esm2015/Subject.js");





let GalleryService = class GalleryService {
    constructor(dataService, http) {
        this.dataService = dataService;
        this.http = http;
        this.api_url = '/api/gallery/';
    }
    SubmitGallery(data) {
        let url = this.api_url + data.id;
        let subject = new rxjs_Subject__WEBPACK_IMPORTED_MODULE_4__["Subject"]();
        let body = {
            name: data.name,
            description: data.description,
            parent: data.parent,
            tags: data.tags,
            useTags: data.useTags,
            showImages: data.showImages
        };
        if (data.id > 0) {
            this.http.put(url, body).subscribe(data => {
                subject.next({ success: data['success'], message: data['message'] });
                this.dataService.setPageData(data);
            });
        }
        else {
            this.http.post(url, body).subscribe(data => {
                subject.next({ success: data['success'], message: data['message'] });
                this.dataService.setPageData(data);
            });
        }
        return subject.asObservable();
    }
    DeleteGallery(id, parent_id) {
        let url = this.api_url + id;
        let subject = new rxjs_Subject__WEBPACK_IMPORTED_MODULE_4__["Subject"]();
        this.http.delete(url)
            .subscribe(data => {
            subject.next({ success: data['success'], message: data['message'] });
        });
        return subject.asObservable();
    }
};
GalleryService = tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"]([
    Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Injectable"])(),
    tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"]("design:paramtypes", [_data_service__WEBPACK_IMPORTED_MODULE_2__["DataService"],
        _angular_common_http__WEBPACK_IMPORTED_MODULE_3__["HttpClient"]])
], GalleryService);



/***/ }),

/***/ "./src/app/services/image_service.ts":
/*!*******************************************!*\
  !*** ./src/app/services/image_service.ts ***!
  \*******************************************/
/*! exports provided: ImageService */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "ImageService", function() { return ImageService; });
/* harmony import */ var tslib__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! tslib */ "./node_modules/tslib/tslib.es6.js");
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @angular/core */ "./node_modules/@angular/core/fesm2015/core.js");
/* harmony import */ var _data_service__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./data.service */ "./src/app/services/data.service.ts");
/* harmony import */ var _angular_common_http__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @angular/common/http */ "./node_modules/@angular/common/fesm2015/http.js");
/* harmony import */ var rxjs_Subject__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! rxjs/Subject */ "./node_modules/rxjs-compat/_esm2015/Subject.js");





let ImageService = class ImageService {
    constructor(dataService, http) {
        this.dataService = dataService;
        this.http = http;
        this.api_url = '/api/image/';
    }
    SubmitImages(data) {
        let url = this.api_url + data.id;
        let subject = new rxjs_Subject__WEBPACK_IMPORTED_MODULE_4__["Subject"]();
        let body = {
            id: data.id,
            gallery_id: data.gallery_id,
            description: data.description,
            tags: data.tags,
            fileHashes: data.fileHashes
        };
        if (data.id > 0) {
            this.http.put(url, body).subscribe(data => {
                subject.next({ success: data['success'], message: data['message'] });
                this.dataService.setPageData(data);
            });
        }
        else {
            this.http.post(url, body).subscribe(data => {
                subject.next({ success: data['success'], message: data['message'] });
                this.dataService.setPageData(data);
            });
        }
        return subject.asObservable();
    }
    DeleteImage(id) {
        let url = this.api_url + id;
        let subject = new rxjs_Subject__WEBPACK_IMPORTED_MODULE_4__["Subject"]();
        this.http.delete(url)
            .subscribe(data => {
            subject.next({ success: data['success'], message: data['message'] });
        });
        return subject.asObservable();
    }
};
ImageService = tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"]([
    Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Injectable"])(),
    tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"]("design:paramtypes", [_data_service__WEBPACK_IMPORTED_MODULE_2__["DataService"],
        _angular_common_http__WEBPACK_IMPORTED_MODULE_3__["HttpClient"]])
], ImageService);



/***/ }),

/***/ "./src/app/services/page_data.service.ts":
/*!***********************************************!*\
  !*** ./src/app/services/page_data.service.ts ***!
  \***********************************************/
/*! exports provided: PageDataService */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "PageDataService", function() { return PageDataService; });
/* harmony import */ var tslib__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! tslib */ "./node_modules/tslib/tslib.es6.js");
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @angular/core */ "./node_modules/@angular/core/fesm2015/core.js");
/* harmony import */ var _data_service__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./data.service */ "./src/app/services/data.service.ts");
/* harmony import */ var _angular_common_http__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @angular/common/http */ "./node_modules/@angular/common/fesm2015/http.js");




let PageDataService = class PageDataService {
    constructor(data_service, http) {
        this.data_service = data_service;
        this.http = http;
        this.api_url = '/api/page_data/';
    }
    GetPageData(url) {
        this.http.get(url).subscribe(data => {
            this.data_service.setPageData(data);
        });
    }
    GetHomePageData() {
        let url = this.api_url + 'home_page';
        this.GetPageData(url);
    }
    GetGalleryPageData(id) {
        let url = this.api_url + 'gallery_page/' + id;
        this.GetPageData(url);
    }
    GetImagePageData(image_id, gallery_id) {
        let url = this.api_url + 'image_page/' + gallery_id + '/' + image_id;
        this.GetPageData(url);
    }
};
PageDataService = tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"]([
    Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Injectable"])(),
    tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"]("design:paramtypes", [_data_service__WEBPACK_IMPORTED_MODULE_2__["DataService"], _angular_common_http__WEBPACK_IMPORTED_MODULE_3__["HttpClient"]])
], PageDataService);



/***/ }),

/***/ "./src/app/services/page_title.service.ts":
/*!************************************************!*\
  !*** ./src/app/services/page_title.service.ts ***!
  \************************************************/
/*! exports provided: PageTitleService */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "PageTitleService", function() { return PageTitleService; });
/* harmony import */ var tslib__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! tslib */ "./node_modules/tslib/tslib.es6.js");
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @angular/core */ "./node_modules/@angular/core/fesm2015/core.js");
/* harmony import */ var _data_service__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./data.service */ "./src/app/services/data.service.ts");



let PageTitleService = class PageTitleService {
    constructor(service) {
        this.service = service;
        this.observer = service.getPageTitleObserver().subscribe(data => {
            document.title = data;
        });
    }
    ngOnDestroy() {
        this.observer.unsubscribe();
    }
};
PageTitleService = tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"]([
    Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Injectable"])(),
    tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"]("design:paramtypes", [_data_service__WEBPACK_IMPORTED_MODULE_2__["DataService"]])
], PageTitleService);



/***/ }),

/***/ "./src/app/services/thumbnail.service.ts":
/*!***********************************************!*\
  !*** ./src/app/services/thumbnail.service.ts ***!
  \***********************************************/
/*! exports provided: ThumbnailService */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "ThumbnailService", function() { return ThumbnailService; });
/* harmony import */ var tslib__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! tslib */ "./node_modules/tslib/tslib.es6.js");
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @angular/core */ "./node_modules/@angular/core/fesm2015/core.js");
/* harmony import */ var rxjs_Subject__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! rxjs/Subject */ "./node_modules/rxjs-compat/_esm2015/Subject.js");
/* harmony import */ var _angular_common_http__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @angular/common/http */ "./node_modules/@angular/common/fesm2015/http.js");




let ThumbnailService = class ThumbnailService {
    constructor(http) {
        this.http = http;
        this.api_url = '/api/thumbnail_status';
    }
    getStatus(data = null) {
        let subject = new rxjs_Subject__WEBPACK_IMPORTED_MODULE_2__["Subject"]();
        let params = data.join(',');
        let url = this.api_url + '?images=' + params;
        this.http.get(url).subscribe(data => {
            subject.next(data);
        });
        return subject.asObservable();
    }
};
ThumbnailService = tslib__WEBPACK_IMPORTED_MODULE_0__["__decorate"]([
    Object(_angular_core__WEBPACK_IMPORTED_MODULE_1__["Injectable"])(),
    tslib__WEBPACK_IMPORTED_MODULE_0__["__metadata"]("design:paramtypes", [_angular_common_http__WEBPACK_IMPORTED_MODULE_3__["HttpClient"]])
], ThumbnailService);



/***/ }),

/***/ "./src/environments/environment.ts":
/*!*****************************************!*\
  !*** ./src/environments/environment.ts ***!
  \*****************************************/
/*! exports provided: environment */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "environment", function() { return environment; });
// The file contents for the current environment will overwrite these during build.
// The build system defaults to the dev environment which uses `environment.ts`, but if you do
// `ng build --env=prod` then `environment.prod.ts` will be used instead.
// The list of which env maps to which file can be found in `.angular-cli.json`.
const environment = {
    production: false
};


/***/ }),

/***/ "./src/main.ts":
/*!*********************!*\
  !*** ./src/main.ts ***!
  \*********************/
/*! no exports provided */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @angular/core */ "./node_modules/@angular/core/fesm2015/core.js");
/* harmony import */ var _angular_platform_browser_dynamic__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @angular/platform-browser-dynamic */ "./node_modules/@angular/platform-browser-dynamic/fesm2015/platform-browser-dynamic.js");
/* harmony import */ var _app_app_module__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./app/app.module */ "./src/app/app.module.ts");
/* harmony import */ var _environments_environment__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./environments/environment */ "./src/environments/environment.ts");




if (_environments_environment__WEBPACK_IMPORTED_MODULE_3__["environment"].production) {
    Object(_angular_core__WEBPACK_IMPORTED_MODULE_0__["enableProdMode"])();
}
Object(_angular_platform_browser_dynamic__WEBPACK_IMPORTED_MODULE_1__["platformBrowserDynamic"])().bootstrapModule(_app_app_module__WEBPACK_IMPORTED_MODULE_2__["AppModule"])
    .catch(err => console.log(err));


/***/ }),

/***/ 0:
/*!***************************!*\
  !*** multi ./src/main.ts ***!
  \***************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /var/www/servers/moa/src/frontend/src/main.ts */"./src/main.ts");


/***/ })

},[[0,"runtime","vendor"]]]);
//# sourceMappingURL=main.js.map