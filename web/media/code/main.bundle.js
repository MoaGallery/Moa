webpackJsonp(["main"],{

/***/ "../../../../../src/$$_lazy_route_resource lazy recursive":
/***/ (function(module, exports) {

function webpackEmptyAsyncContext(req) {
	// Here Promise.resolve().then() is used instead of new Promise() to prevent
	// uncatched exception popping up in devtools
	return Promise.resolve().then(function() {
		throw new Error("Cannot find module '" + req + "'.");
	});
}
webpackEmptyAsyncContext.keys = function() { return []; };
webpackEmptyAsyncContext.resolve = webpackEmptyAsyncContext;
module.exports = webpackEmptyAsyncContext;
webpackEmptyAsyncContext.id = "../../../../../src/$$_lazy_route_resource lazy recursive";

/***/ }),

/***/ "../../../../../src/app/app.component.css":
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__("../../../../css-loader/lib/css-base.js")(false);
// imports


// module
exports.push([module.i, "", ""]);

// exports


/*** EXPORTS FROM exports-loader ***/
module.exports = module.exports.toString();

/***/ }),

/***/ "../../../../../src/app/app.component.html":
/***/ (function(module, exports) {

module.exports = "<breadcrumb></breadcrumb>\n\n<router-outlet></router-outlet>"

/***/ }),

/***/ "../../../../../src/app/app.component.ts":
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "a", function() { return AppComponent; });
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__angular_core__ = __webpack_require__("../../../core/esm5/core.js");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__services_data_service__ = __webpack_require__("../../../../../src/app/services/data.service.ts");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_2__angular_router__ = __webpack_require__("../../../router/esm5/router.js");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_3__services_page_title_service__ = __webpack_require__("../../../../../src/app/services/page_title.service.ts");
var __decorate = (this && this.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};
var __metadata = (this && this.__metadata) || function (k, v) {
    if (typeof Reflect === "object" && typeof Reflect.metadata === "function") return Reflect.metadata(k, v);
};




var AppComponent = (function () {
    function AppComponent(router, service, pageTitleService, elementRef) {
        this.router = router;
        this.service = service;
        this.pageTitleService = pageTitleService;
        this.elementRef = elementRef;
        this.preload = {};
        this.data = [];
        this.preload = JSON.parse(this.elementRef.nativeElement.getAttribute('[preload]'));
    }
    AppComponent.prototype.ngOnInit = function () {
        this.service.setPageData(this.preload);
    };
    AppComponent = __decorate([
        Object(__WEBPACK_IMPORTED_MODULE_0__angular_core__["Component"])({
            selector: 'app-root',
            template: __webpack_require__("../../../../../src/app/app.component.html"),
            styles: [__webpack_require__("../../../../../src/app/app.component.css")]
        }),
        __metadata("design:paramtypes", [__WEBPACK_IMPORTED_MODULE_2__angular_router__["b" /* Router */],
            __WEBPACK_IMPORTED_MODULE_1__services_data_service__["a" /* DataService */],
            __WEBPACK_IMPORTED_MODULE_3__services_page_title_service__["a" /* PageTitleService */],
            __WEBPACK_IMPORTED_MODULE_0__angular_core__["ElementRef"]])
    ], AppComponent);
    return AppComponent;
}());



/***/ }),

/***/ "../../../../../src/app/app.module.ts":
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "a", function() { return AppModule; });
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__angular_platform_browser__ = __webpack_require__("../../../platform-browser/esm5/platform-browser.js");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__angular_core__ = __webpack_require__("../../../core/esm5/core.js");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_2__app_component__ = __webpack_require__("../../../../../src/app/app.component.ts");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_3__breadcrumb_breadcrumb_component__ = __webpack_require__("../../../../../src/app/breadcrumb/breadcrumb.component.ts");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_4__gallery_gallery_list_gallery_list_component__ = __webpack_require__("../../../../../src/app/gallery/gallery-list/gallery-list.component.ts");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_5__gallery_gallery_tile_gallery_tile_component__ = __webpack_require__("../../../../../src/app/gallery/gallery-tile/gallery-tile.component.ts");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_6__services_data_service__ = __webpack_require__("../../../../../src/app/services/data.service.ts");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_7__services_page_title_service__ = __webpack_require__("../../../../../src/app/services/page_title.service.ts");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_8__services_page_data_service__ = __webpack_require__("../../../../../src/app/services/page_data.service.ts");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_9__angular_common_http__ = __webpack_require__("../../../common/esm5/http.js");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_10__angular_router__ = __webpack_require__("../../../router/esm5/router.js");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_11__pages_gallery_page_gallery_page_component__ = __webpack_require__("../../../../../src/app/pages/gallery-page/gallery-page.component.ts");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_12__pages_home_page_home_page_component__ = __webpack_require__("../../../../../src/app/pages/home-page/home-page.component.ts");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_13__gallery_gallery_info_gallery_info_component__ = __webpack_require__("../../../../../src/app/gallery/gallery-info/gallery-info.component.ts");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_14__image_image_list_image_list_component__ = __webpack_require__("../../../../../src/app/image/image-list/image-list.component.ts");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_15__image_image_thumb_image_thumb_component__ = __webpack_require__("../../../../../src/app/image/image-thumb/image-thumb.component.ts");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_16__gallery_gallery_toolbar_gallery_toolbar_component__ = __webpack_require__("../../../../../src/app/gallery/gallery-toolbar/gallery-toolbar.component.ts");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_17__gallery_gallery_edit_gallery_edit_component__ = __webpack_require__("../../../../../src/app/gallery/gallery-edit/gallery-edit.component.ts");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_18__services_button_click_service__ = __webpack_require__("../../../../../src/app/services/button-click.service.ts");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_19__angular_forms__ = __webpack_require__("../../../forms/esm5/forms.js");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_20__services_gallery_service__ = __webpack_require__("../../../../../src/app/services/gallery_service.ts");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_21__services_image_service__ = __webpack_require__("../../../../../src/app/services/image_service.ts");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_22__pages_image_page_image_page_component__ = __webpack_require__("../../../../../src/app/pages/image-page/image-page.component.ts");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_23__image_image_info_image_info_component__ = __webpack_require__("../../../../../src/app/image/image-info/image-info.component.ts");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_24__image_image_toolbar_image_toolbar_component__ = __webpack_require__("../../../../../src/app/image/image-toolbar/image-toolbar.component.ts");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_25__image_image_edit_image_edit_component__ = __webpack_require__("../../../../../src/app/image/image-edit/image-edit.component.ts");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_26__services_thumbnail_service__ = __webpack_require__("../../../../../src/app/services/thumbnail.service.ts");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_27__image_image_add_image_add_component__ = __webpack_require__("../../../../../src/app/image/image-add/image-add.component.ts");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_28_primeng_components_fileupload_fileupload__ = __webpack_require__("../../../../primeng/components/fileupload/fileupload.js");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_28_primeng_components_fileupload_fileupload___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_28_primeng_components_fileupload_fileupload__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_29__home_home_toolbar_home_toolbar_component__ = __webpack_require__("../../../../../src/app/home/home-toolbar/home-toolbar.component.ts");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_30__ngbox_ngbox_service__ = __webpack_require__("../../../../../src/app/ngbox/ngbox.service.ts");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_31__ngbox_ngbox_component__ = __webpack_require__("../../../../../src/app/ngbox/ngbox.component.ts");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_32__ngbox_ngbox_directive__ = __webpack_require__("../../../../../src/app/ngbox/ngbox.directive.ts");
var __decorate = (this && this.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};

































var routes = [
    { path: '', component: __WEBPACK_IMPORTED_MODULE_12__pages_home_page_home_page_component__["a" /* HomePageComponent */] },
    { path: 'gallery/:id', component: __WEBPACK_IMPORTED_MODULE_11__pages_gallery_page_gallery_page_component__["a" /* GalleryPageComponent */] },
    { path: 'image/:gallery_id/:image_id', component: __WEBPACK_IMPORTED_MODULE_22__pages_image_page_image_page_component__["a" /* ImagePageComponent */] }
];
var AppModule = (function () {
    function AppModule() {
    }
    AppModule = __decorate([
        Object(__WEBPACK_IMPORTED_MODULE_1__angular_core__["NgModule"])({
            declarations: [
                __WEBPACK_IMPORTED_MODULE_2__app_component__["a" /* AppComponent */],
                __WEBPACK_IMPORTED_MODULE_3__breadcrumb_breadcrumb_component__["a" /* BreadcrumbComponent */],
                __WEBPACK_IMPORTED_MODULE_4__gallery_gallery_list_gallery_list_component__["a" /* GalleryListComponent */],
                __WEBPACK_IMPORTED_MODULE_5__gallery_gallery_tile_gallery_tile_component__["a" /* GalleryTileComponent */],
                __WEBPACK_IMPORTED_MODULE_13__gallery_gallery_info_gallery_info_component__["a" /* GalleryInfoComponent */],
                __WEBPACK_IMPORTED_MODULE_16__gallery_gallery_toolbar_gallery_toolbar_component__["a" /* GalleryToolbarComponent */],
                __WEBPACK_IMPORTED_MODULE_17__gallery_gallery_edit_gallery_edit_component__["a" /* GalleryEditComponent */],
                __WEBPACK_IMPORTED_MODULE_14__image_image_list_image_list_component__["a" /* ImageListComponent */],
                __WEBPACK_IMPORTED_MODULE_15__image_image_thumb_image_thumb_component__["a" /* ImageThumbComponent */],
                __WEBPACK_IMPORTED_MODULE_23__image_image_info_image_info_component__["a" /* ImageInfoComponent */],
                __WEBPACK_IMPORTED_MODULE_29__home_home_toolbar_home_toolbar_component__["a" /* HomeToolbarComponent */],
                // Route pages
                __WEBPACK_IMPORTED_MODULE_12__pages_home_page_home_page_component__["a" /* HomePageComponent */],
                __WEBPACK_IMPORTED_MODULE_11__pages_gallery_page_gallery_page_component__["a" /* GalleryPageComponent */],
                __WEBPACK_IMPORTED_MODULE_22__pages_image_page_image_page_component__["a" /* ImagePageComponent */],
                __WEBPACK_IMPORTED_MODULE_24__image_image_toolbar_image_toolbar_component__["a" /* ImageToolbarComponent */],
                __WEBPACK_IMPORTED_MODULE_25__image_image_edit_image_edit_component__["a" /* ImageEditComponent */],
                __WEBPACK_IMPORTED_MODULE_27__image_image_add_image_add_component__["a" /* ImageAddComponent */],
                __WEBPACK_IMPORTED_MODULE_31__ngbox_ngbox_component__["a" /* NgBoxComponent */],
                __WEBPACK_IMPORTED_MODULE_32__ngbox_ngbox_directive__["a" /* NgBoxDirective */]
            ],
            imports: [
                __WEBPACK_IMPORTED_MODULE_0__angular_platform_browser__["BrowserModule"],
                __WEBPACK_IMPORTED_MODULE_9__angular_common_http__["b" /* HttpClientModule */],
                __WEBPACK_IMPORTED_MODULE_10__angular_router__["c" /* RouterModule */].forRoot(routes),
                __WEBPACK_IMPORTED_MODULE_19__angular_forms__["a" /* FormsModule */],
                __WEBPACK_IMPORTED_MODULE_28_primeng_components_fileupload_fileupload__["FileUploadModule"]
            ],
            providers: [
                __WEBPACK_IMPORTED_MODULE_6__services_data_service__["a" /* DataService */],
                __WEBPACK_IMPORTED_MODULE_7__services_page_title_service__["a" /* PageTitleService */],
                __WEBPACK_IMPORTED_MODULE_8__services_page_data_service__["a" /* PageDataService */],
                __WEBPACK_IMPORTED_MODULE_18__services_button_click_service__["a" /* ButtonClickService */],
                __WEBPACK_IMPORTED_MODULE_20__services_gallery_service__["a" /* GalleryService */],
                __WEBPACK_IMPORTED_MODULE_21__services_image_service__["a" /* ImageService */],
                __WEBPACK_IMPORTED_MODULE_26__services_thumbnail_service__["a" /* ThumbnailService */],
                __WEBPACK_IMPORTED_MODULE_30__ngbox_ngbox_service__["a" /* NgBoxService */]
            ],
            bootstrap: [
                __WEBPACK_IMPORTED_MODULE_2__app_component__["a" /* AppComponent */]
            ]
        })
    ], AppModule);
    return AppModule;
}());



/***/ }),

/***/ "../../../../../src/app/breadcrumb/breadcrumb.component.css":
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__("../../../../css-loader/lib/css-base.js")(false);
// imports


// module
exports.push([module.i, "", ""]);

// exports


/*** EXPORTS FROM exports-loader ***/
module.exports = module.exports.toString();

/***/ }),

/***/ "../../../../../src/app/breadcrumb/breadcrumb.component.html":
/***/ (function(module, exports) {

module.exports = "<ol class=\"breadcrumb\">\n\t<li><a [routerLink]=\"['/']\">Home</a></li>\n\n\t<li *ngFor=\"let crumb of crumbs; let last = last\">\n\t  <a *ngIf=\"!last\"  [routerLink]=\"[getLink(crumb.id)]\">{{crumb.name}}</a>\n\t  <span *ngIf=\"last\">{{crumb.name}}</span>\n\t</li>\n</ol>\n"

/***/ }),

/***/ "../../../../../src/app/breadcrumb/breadcrumb.component.ts":
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "a", function() { return BreadcrumbComponent; });
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__angular_core__ = __webpack_require__("../../../core/esm5/core.js");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__services_data_service__ = __webpack_require__("../../../../../src/app/services/data.service.ts");
var __decorate = (this && this.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};
var __metadata = (this && this.__metadata) || function (k, v) {
    if (typeof Reflect === "object" && typeof Reflect.metadata === "function") return Reflect.metadata(k, v);
};


var BreadcrumbComponent = (function () {
    function BreadcrumbComponent(service) {
        var _this = this;
        this.service = service;
        this.observer = service.getBreadcrumbObserver().subscribe(function (data) {
            _this.crumbs = data;
        });
    }
    BreadcrumbComponent.prototype.ngOnDestroy = function () {
        this.observer.unsubscribe();
    };
    BreadcrumbComponent.prototype.getLink = function (id) {
        for (var i = 0; i < this.crumbs.length; i++) {
            if (this.crumbs[i].id == id) {
                return '/' + this.crumbs[i].type + '/' + this.crumbs[i].id;
            }
        }
        return '/';
    };
    BreadcrumbComponent = __decorate([
        Object(__WEBPACK_IMPORTED_MODULE_0__angular_core__["Component"])({
            selector: 'breadcrumb',
            template: __webpack_require__("../../../../../src/app/breadcrumb/breadcrumb.component.html"),
            styles: [__webpack_require__("../../../../../src/app/breadcrumb/breadcrumb.component.css")]
        }),
        __metadata("design:paramtypes", [__WEBPACK_IMPORTED_MODULE_1__services_data_service__["a" /* DataService */]])
    ], BreadcrumbComponent);
    return BreadcrumbComponent;
}());



/***/ }),

/***/ "../../../../../src/app/gallery/gallery-edit/gallery-edit.component.css":
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__("../../../../css-loader/lib/css-base.js")(false);
// imports


// module
exports.push([module.i, "", ""]);

// exports


/*** EXPORTS FROM exports-loader ***/
module.exports = module.exports.toString();

/***/ }),

/***/ "../../../../../src/app/gallery/gallery-edit/gallery-edit.component.html":
/***/ (function(module, exports) {

module.exports = "<div class=\"modal fade\" id=\"edit-modal\">\n\t<div class=\"modal-dialog\">\n\t\t<div class=\"modal-content\">\n\t\t\t<div class=\"modal-header\">\n\t\t\t\t<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>\n\t\t\t\t<h4 class=\"modal-title\">Edit gallery</h4>\n\t\t\t</div>\n\t\t\t<form action=\"/gallery/{{gallery.id}}\" method=\"post\" class=\"form-horizontal\">\n\t\t\t\t<div class=\"modal-body\">\n\n\t\t\t\t\t<div class=\"form-group\">\n\t\t\t\t\t\t<label for=\"inputGalleryName\" class=\"col-sm-2 control-label\">Name</label>\n\t\t\t\t\t\t<div class=\"col-sm-10\">\n\t\t\t\t\t\t\t<input type=\"text\" class=\"form-control\" name=\"inputGalleryName\" id=\"inputGalleryName\" placeholder=\"Edit...\" [(ngModel)]=\"name\">\n\t\t\t\t\t\t</div>\n\t\t\t\t\t</div>\n\n\t\t\t\t\t<div class=\"form-group\">\n\t\t\t\t\t\t<label for=\"inputGalleryDescription\" class=\"col-sm-2 control-label\">Description</label>\n\t\t\t\t\t\t<div class=\"col-sm-10\">\n\t\t\t\t\t\t\t<textarea class=\"form-control\" name=\"inputGalleryDescription\" id=\"inputGalleryDescription\" placeholder=\"Edit...\" [(ngModel)]=\"description\"></textarea>\n\t\t\t\t\t\t</div>\n\t\t\t\t\t</div>\n\n\t\t\t\t\t<div class=\"form-group\">\n\t\t\t\t\t\t<label for=\"inputGalleryParent\" class=\"col-sm-2 control-label\">Parent</label>\n\t\t\t\t\t\t<div class=\"col-sm-10\">\n\t\t\t\t\t\t\t<select class=\"form-control\" name=\"inputGalleryParent\" id=\"inputGalleryParent\" style=\"width: 100%\">\n\t\t\t\t\t\t\t\t<option value=\"{{parent_gallery.id}}\" selected=\"selected\">{{parent_gallery.name}}</option>\n\t\t\t\t\t\t\t</select>\n\t\t\t\t\t\t</div>\n\t\t\t\t\t</div>\n\n\t\t\t\t\t<div class=\"form-group\">\n\t\t\t\t\t\t<label for=\"inputGalleryTags\" class=\"col-sm-2 control-label\">Tags</label>\n\t\t\t\t\t\t<div class=\"col-sm-10\">\n\t\t\t\t\t\t\t<select class=\"form-control\" name=\"inputGalleryTags[]\" id=\"inputGalleryTags\" style=\"width: 100%\" multiple>\n\t\t\t\t\t\t\t\t<option *ngFor=\"let tag of tagList\" value=\"{{tag.id}}\" selected=\"selected\">{{tag.name}}</option>\n\t\t\t\t\t\t\t</select>\n\t\t\t\t\t\t</div>\n\t\t\t\t\t</div>\n\n\t\t\t\t\t<div class=\"form-group\">\n\t\t\t\t\t\t<div class=\"checkbox\">\n\t\t\t\t\t\t\t<div class=\"col-sm-2\"></div>\n\t\t\t\t\t\t\t<div class=\"col-sm-10\">\n\t\t\t\t\t\t\t\t<input type=\"checkbox\" name=\"inputGalleryCombinedView\" id=\"inputGalleryCombinedView\" [(ngModel)]=\"showImages\">\n\t\t\t\t\t\t\t\t<label for=\"inputGalleryCombinedView\" class=\"control-label\">Show images when there are subgalleries</label>\n\t\t\t\t\t\t\t</div>\n\t\t\t\t\t\t</div>\n\t\t\t\t\t</div>\n\n\t\t\t\t\t<div class=\"form-group\">\n\t\t\t\t\t\t<div class=\"checkbox\">\n\t\t\t\t\t\t\t<div class=\"col-sm-2\"></div>\n\t\t\t\t\t\t\t<div class=\"col-sm-10\">\n\t\t\t\t\t\t\t\t<input type=\"checkbox\" name=\"inputGalleryUseTags\" id=\"inputGalleryUseTags\" [(ngModel)]=\"useTags\">\n\t\t\t\t\t\t\t\t<label for=\"inputGalleryUseTags\" class=\"control-label\">Populate from tags</label>\n\t\t\t\t\t\t\t</div>\n\t\t\t\t\t\t</div>\n\t\t\t\t\t</div>\n\t\t\t\t</div>\n\n\t\t\t\t<div class=\"modal-footer\">\n\t\t\t\t\t<button type=\"button\" class=\"btn btn-default\" data-dismiss=\"modal\">Close</button>\n\t\t\t\t\t<input (click)=\"onSubmit()\" type=\"submit\" class=\"btn btn-primary\" value=\"Save changes\">\n\t\t\t\t</div>\n\t\t\t</form>\n\t\t</div><!-- /.modal-content -->\n\t</div><!-- /.modal-dialog -->\n</div><!-- /.modal -->\n"

/***/ }),

/***/ "../../../../../src/app/gallery/gallery-edit/gallery-edit.component.ts":
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "a", function() { return GalleryEditComponent; });
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__angular_core__ = __webpack_require__("../../../core/esm5/core.js");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__services_button_click_service__ = __webpack_require__("../../../../../src/app/services/button-click.service.ts");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_2__services_gallery_service__ = __webpack_require__("../../../../../src/app/services/gallery_service.ts");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_3__angular_router__ = __webpack_require__("../../../router/esm5/router.js");
var __decorate = (this && this.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};
var __metadata = (this && this.__metadata) || function (k, v) {
    if (typeof Reflect === "object" && typeof Reflect.metadata === "function") return Reflect.metadata(k, v);
};




var GalleryEditComponent = (function () {
    function GalleryEditComponent(buttonClickService, galleryService, router) {
        var _this = this;
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
        this.subscription = this.buttonClickService.notifyObservable$.subscribe(function (data) {
            if ((data.name !== 'galleryEditClick') &&
                (data.name !== 'galleryAddClick')) {
                return;
            }
            _this.addMode = data.name === 'galleryAddClick';
            _this.reset();
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
    GalleryEditComponent.prototype.reset = function () {
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
        for (var _i = 0, _a = this.gallery.tag_list; _i < _a.length; _i++) {
            var tag = _a[_i];
            this.tagList.push({ name: tag.name, id: '' + tag.id });
        }
    };
    GalleryEditComponent.prototype.onSubmit = function () {
        var _this = this;
        // Select2 isn't synchronising so we have to get the selections manually
        var tagData = $('#inputGalleryTags').select2('data');
        var tags = [];
        for (var _i = 0, tagData_1 = tagData; _i < tagData_1.length; _i++) {
            var tag = tagData_1[_i];
            tags.push(tag.id);
        }
        var galleryData = $('#inputGalleryParent').select2('data');
        this.parent_gallery.id = galleryData[0].id;
        var id = 0;
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
        }).subscribe(function (data) {
            var options = {
                message: 'Gallery saved',
                container: '#editSuccessContainer',
                duration: 5000
            };
            $.meow(options);
            $('#inputGalleryTags').children().remove();
            $('#edit-modal').modal('hide');
            if (_this.addMode) {
                _this.router.navigate(['/gallery/' + data.message]);
            }
        });
    };
    GalleryEditComponent.prototype.ngOnDestroy = function () {
        this.subscription.unsubscribe();
    };
    __decorate([
        Object(__WEBPACK_IMPORTED_MODULE_0__angular_core__["Input"])(),
        __metadata("design:type", Object)
    ], GalleryEditComponent.prototype, "gallery", void 0);
    GalleryEditComponent = __decorate([
        Object(__WEBPACK_IMPORTED_MODULE_0__angular_core__["Component"])({
            selector: 'gallery-edit',
            template: __webpack_require__("../../../../../src/app/gallery/gallery-edit/gallery-edit.component.html"),
            styles: [__webpack_require__("../../../../../src/app/gallery/gallery-edit/gallery-edit.component.css")]
        }),
        __metadata("design:paramtypes", [__WEBPACK_IMPORTED_MODULE_1__services_button_click_service__["a" /* ButtonClickService */],
            __WEBPACK_IMPORTED_MODULE_2__services_gallery_service__["a" /* GalleryService */],
            __WEBPACK_IMPORTED_MODULE_3__angular_router__["b" /* Router */]])
    ], GalleryEditComponent);
    return GalleryEditComponent;
}());



/***/ }),

/***/ "../../../../../src/app/gallery/gallery-info/gallery-info.component.css":
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__("../../../../css-loader/lib/css-base.js")(false);
// imports


// module
exports.push([module.i, "", ""]);

// exports


/*** EXPORTS FROM exports-loader ***/
module.exports = module.exports.toString();

/***/ }),

/***/ "../../../../../src/app/gallery/gallery-info/gallery-info.component.html":
/***/ (function(module, exports) {

module.exports = "<h1>{{gallery.name}}</h1>\n<p>\n\t{{gallery.description}}\n</p>"

/***/ }),

/***/ "../../../../../src/app/gallery/gallery-info/gallery-info.component.ts":
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "a", function() { return GalleryInfoComponent; });
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__angular_core__ = __webpack_require__("../../../core/esm5/core.js");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__services_data_service__ = __webpack_require__("../../../../../src/app/services/data.service.ts");
var __decorate = (this && this.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};
var __metadata = (this && this.__metadata) || function (k, v) {
    if (typeof Reflect === "object" && typeof Reflect.metadata === "function") return Reflect.metadata(k, v);
};


var GalleryInfoComponent = (function () {
    function GalleryInfoComponent(service) {
        var _this = this;
        this.service = service;
        this.gallery = {
            name: '',
            description: ''
        };
        this.observer = service.getGalleryObserver().subscribe(function (data) {
            _this.gallery = data;
        });
    }
    GalleryInfoComponent.prototype.ngOnDestroy = function () {
        this.observer.unsubscribe();
    };
    GalleryInfoComponent = __decorate([
        Object(__WEBPACK_IMPORTED_MODULE_0__angular_core__["Component"])({
            selector: 'gallery-info',
            template: __webpack_require__("../../../../../src/app/gallery/gallery-info/gallery-info.component.html"),
            styles: [__webpack_require__("../../../../../src/app/gallery/gallery-info/gallery-info.component.css")]
        }),
        __metadata("design:paramtypes", [__WEBPACK_IMPORTED_MODULE_1__services_data_service__["a" /* DataService */]])
    ], GalleryInfoComponent);
    return GalleryInfoComponent;
}());



/***/ }),

/***/ "../../../../../src/app/gallery/gallery-list/gallery-list.component.css":
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__("../../../../css-loader/lib/css-base.js")(false);
// imports


// module
exports.push([module.i, ".thumbnail {\n    height: 250px;\n}", ""]);

// exports


/*** EXPORTS FROM exports-loader ***/
module.exports = module.exports.toString();

/***/ }),

/***/ "../../../../../src/app/gallery/gallery-list/gallery-list.component.html":
/***/ (function(module, exports) {

module.exports = "<div class=\"row\">\n\t<ul class=\"list-unstyled\">\n\t\t<li *ngFor=\"let gallery of galleries\" class=\"thumbnail col-md-3\" style=\"min-height: 150px;\">\n\t\t\t<gallery-tile [gallery]=\"gallery\"></gallery-tile>\n\t\t</li>\n\t</ul>\n</div>"

/***/ }),

/***/ "../../../../../src/app/gallery/gallery-list/gallery-list.component.ts":
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "a", function() { return GalleryListComponent; });
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__angular_core__ = __webpack_require__("../../../core/esm5/core.js");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__services_data_service__ = __webpack_require__("../../../../../src/app/services/data.service.ts");
var __decorate = (this && this.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};
var __metadata = (this && this.__metadata) || function (k, v) {
    if (typeof Reflect === "object" && typeof Reflect.metadata === "function") return Reflect.metadata(k, v);
};


var GalleryListComponent = (function () {
    function GalleryListComponent(service) {
        var _this = this;
        this.service = service;
        this.observer = service.getGalleriesObserver().subscribe(function (data) {
            _this.galleries = data;
        });
    }
    GalleryListComponent.prototype.ngOnDestroy = function () {
        this.observer.unsubscribe();
    };
    GalleryListComponent = __decorate([
        Object(__WEBPACK_IMPORTED_MODULE_0__angular_core__["Component"])({
            selector: 'gallery-list',
            template: __webpack_require__("../../../../../src/app/gallery/gallery-list/gallery-list.component.html"),
            styles: [__webpack_require__("../../../../../src/app/gallery/gallery-list/gallery-list.component.css")]
        }),
        __metadata("design:paramtypes", [__WEBPACK_IMPORTED_MODULE_1__services_data_service__["a" /* DataService */]])
    ], GalleryListComponent);
    return GalleryListComponent;
}());



/***/ }),

/***/ "../../../../../src/app/gallery/gallery-tile/gallery-tile.component.css":
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__("../../../../css-loader/lib/css-base.js")(false);
// imports


// module
exports.push([module.i, "", ""]);

// exports


/*** EXPORTS FROM exports-loader ***/
module.exports = module.exports.toString();

/***/ }),

/***/ "../../../../../src/app/gallery/gallery-tile/gallery-tile.component.html":
/***/ (function(module, exports) {

module.exports = "<a [routerLink]=\"[getLink(gallery.id)]\">\n\t<img *ngIf=\"!doesThumbExist(gallery.thumb_id)\" src=\"http://placehold.it/300x200\">\n\t<img *ngIf=\"doesThumbExist(gallery.thumb_id)\" src=\"/image/thumb/{{gallery.thumb_id}}.jpg\">\n\t<h4>{{gallery.name}}</h4>\n</a>"

/***/ }),

/***/ "../../../../../src/app/gallery/gallery-tile/gallery-tile.component.ts":
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "a", function() { return GalleryTileComponent; });
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__angular_core__ = __webpack_require__("../../../core/esm5/core.js");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__models_gallery_model__ = __webpack_require__("../../../../../src/app/models/gallery.model.ts");
var __decorate = (this && this.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};
var __metadata = (this && this.__metadata) || function (k, v) {
    if (typeof Reflect === "object" && typeof Reflect.metadata === "function") return Reflect.metadata(k, v);
};


var GalleryTileComponent = (function () {
    function GalleryTileComponent() {
    }
    GalleryTileComponent.prototype.getLink = function (id) {
        return '/gallery/' + this.gallery.id;
    };
    GalleryTileComponent.prototype.doesThumbExist = function (thumb_id) {
        return thumb_id !== null;
    };
    __decorate([
        Object(__WEBPACK_IMPORTED_MODULE_0__angular_core__["Input"])(),
        __metadata("design:type", __WEBPACK_IMPORTED_MODULE_1__models_gallery_model__["a" /* Gallery */])
    ], GalleryTileComponent.prototype, "gallery", void 0);
    GalleryTileComponent = __decorate([
        Object(__WEBPACK_IMPORTED_MODULE_0__angular_core__["Component"])({
            selector: 'gallery-tile',
            template: __webpack_require__("../../../../../src/app/gallery/gallery-tile/gallery-tile.component.html"),
            styles: [__webpack_require__("../../../../../src/app/gallery/gallery-tile/gallery-tile.component.css")]
        }),
        __metadata("design:paramtypes", [])
    ], GalleryTileComponent);
    return GalleryTileComponent;
}());



/***/ }),

/***/ "../../../../../src/app/gallery/gallery-toolbar/gallery-toolbar.component.css":
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__("../../../../css-loader/lib/css-base.js")(false);
// imports


// module
exports.push([module.i, "", ""]);

// exports


/*** EXPORTS FROM exports-loader ***/
module.exports = module.exports.toString();

/***/ }),

/***/ "../../../../../src/app/gallery/gallery-toolbar/gallery-toolbar.component.html":
/***/ (function(module, exports) {

module.exports = "<gallery-edit [gallery]=\"gallery\"></gallery-edit>\n<image-add [gallery]=\"gallery\"></image-add>\n\n<div class=\"row\">\n\t<div class=\"pull-right\">\n\t\t<div class=\"btn-group\" role=\"group\" aria-label=\"...\">\n\t\t\t<button type=\"button\" (click)=\"onAddGalleryClick()\" class=\"btn btn-default\" id=\"galleryAdd\" title=\"Add gallery\" data-toggle=\"tooltip\"><span class=\"glyphicon glyphicon-th\"></span></button>\n\t\t\t<button type=\"button\" (click)=\"onAddImageClick()\" class=\"btn btn-default\" id=\"imageAdd\" title=\"Add image\" data-toggle=\"tooltip\"><span class=\"glyphicon glyphicon-picture\"></span></button>\n\t\t\t<button type=\"button\" (click)=\"onEditClick()\" class=\"btn btn-default\" id=\"galleryEdit\" title=\"Edit gallery\" data-toggle=\"tooltip\"><span class=\"glyphicon glyphicon-pencil\"></span></button>\n\t\t\t<button type=\"button\" (click)=\"onDeleteClick()\" class=\"btn btn-default\" id=\"galleryDelete\" title=\"Delete gallery\" data-toggle=\"tooltip\"><span class=\"glyphicon glyphicon-trash\"></span></button>\n\t\t</div>\n\t</div>\n</div>"

/***/ }),

/***/ "../../../../../src/app/gallery/gallery-toolbar/gallery-toolbar.component.ts":
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "a", function() { return GalleryToolbarComponent; });
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__angular_core__ = __webpack_require__("../../../core/esm5/core.js");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__services_data_service__ = __webpack_require__("../../../../../src/app/services/data.service.ts");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_2__services_button_click_service__ = __webpack_require__("../../../../../src/app/services/button-click.service.ts");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_3__services_gallery_service__ = __webpack_require__("../../../../../src/app/services/gallery_service.ts");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_4__angular_router__ = __webpack_require__("../../../router/esm5/router.js");
var __decorate = (this && this.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};
var __metadata = (this && this.__metadata) || function (k, v) {
    if (typeof Reflect === "object" && typeof Reflect.metadata === "function") return Reflect.metadata(k, v);
};





var GalleryToolbarComponent = (function () {
    function GalleryToolbarComponent(dataService, buttonClickService, galleryService, router) {
        var _this = this;
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
        this.observer = dataService.getGalleryObserver().subscribe(function (data) {
            _this.gallery = data;
        });
    }
    GalleryToolbarComponent.prototype.onEditClick = function () {
        this.buttonClickService.trigger('galleryEditClick');
    };
    GalleryToolbarComponent.prototype.onAddGalleryClick = function () {
        this.buttonClickService.trigger('galleryAddClick');
    };
    GalleryToolbarComponent.prototype.onAddImageClick = function () {
        this.buttonClickService.trigger('imageAddClick');
    };
    GalleryToolbarComponent.prototype.onDeleteClick = function () {
        var _this = this;
        if (confirm('Delete this gallery?')) {
            this.galleryService.DeleteGallery(this.gallery.id, this.gallery.parent_id).subscribe(function (next) {
                var options = {
                    message: 'Gallery deleted',
                    container: '#editSuccessContainer',
                    duration: 5000
                };
                $.meow(options);
                if (_this.gallery.parent_id > 0)
                    _this.router.navigate(['/gallery/' + _this.gallery.parent_id]);
                else
                    _this.router.navigate(['/']);
            });
        }
    };
    GalleryToolbarComponent.prototype.ngOnDestroy = function () {
        this.observer.unsubscribe();
    };
    GalleryToolbarComponent = __decorate([
        Object(__WEBPACK_IMPORTED_MODULE_0__angular_core__["Component"])({
            selector: 'gallery-toolbar',
            template: __webpack_require__("../../../../../src/app/gallery/gallery-toolbar/gallery-toolbar.component.html"),
            styles: [__webpack_require__("../../../../../src/app/gallery/gallery-toolbar/gallery-toolbar.component.css")]
        }),
        __metadata("design:paramtypes", [__WEBPACK_IMPORTED_MODULE_1__services_data_service__["a" /* DataService */],
            __WEBPACK_IMPORTED_MODULE_2__services_button_click_service__["a" /* ButtonClickService */],
            __WEBPACK_IMPORTED_MODULE_3__services_gallery_service__["a" /* GalleryService */],
            __WEBPACK_IMPORTED_MODULE_4__angular_router__["b" /* Router */]])
    ], GalleryToolbarComponent);
    return GalleryToolbarComponent;
}());



/***/ }),

/***/ "../../../../../src/app/home/home-toolbar/home-toolbar.component.css":
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__("../../../../css-loader/lib/css-base.js")(false);
// imports


// module
exports.push([module.i, "", ""]);

// exports


/*** EXPORTS FROM exports-loader ***/
module.exports = module.exports.toString();

/***/ }),

/***/ "../../../../../src/app/home/home-toolbar/home-toolbar.component.html":
/***/ (function(module, exports) {

module.exports = "<gallery-edit [gallery]=\"gallery\"></gallery-edit>\n\n<div class=\"row\">\n\t<div class=\"pull-right\">\n\t\t<div class=\"btn-group\" role=\"group\" aria-label=\"...\">\n\t\t\t<button type=\"button\" (click)=\"onAddGalleryClick()\" class=\"btn btn-default\" id=\"galleryAdd\" title=\"Add gallery\" data-toggle=\"tooltip\"><span class=\"glyphicon glyphicon-th\"></span></button>\n\t\t</div>\n\t</div>\n</div>"

/***/ }),

/***/ "../../../../../src/app/home/home-toolbar/home-toolbar.component.ts":
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "a", function() { return HomeToolbarComponent; });
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__angular_core__ = __webpack_require__("../../../core/esm5/core.js");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__services_data_service__ = __webpack_require__("../../../../../src/app/services/data.service.ts");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_2__services_button_click_service__ = __webpack_require__("../../../../../src/app/services/button-click.service.ts");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_3__services_gallery_service__ = __webpack_require__("../../../../../src/app/services/gallery_service.ts");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_4__angular_router__ = __webpack_require__("../../../router/esm5/router.js");
var __decorate = (this && this.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};
var __metadata = (this && this.__metadata) || function (k, v) {
    if (typeof Reflect === "object" && typeof Reflect.metadata === "function") return Reflect.metadata(k, v);
};





var HomeToolbarComponent = (function () {
    function HomeToolbarComponent(dataService, buttonClickService, galleryService, router) {
        var _this = this;
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
        this.observer = dataService.getGalleryObserver().subscribe(function (data) {
            _this.gallery = data;
        });
    }
    HomeToolbarComponent.prototype.onAddGalleryClick = function () {
        this.buttonClickService.trigger('galleryAddClick');
    };
    HomeToolbarComponent.prototype.ngOnDestroy = function () {
        this.observer.unsubscribe();
    };
    HomeToolbarComponent = __decorate([
        Object(__WEBPACK_IMPORTED_MODULE_0__angular_core__["Component"])({
            selector: 'home-toolbar',
            template: __webpack_require__("../../../../../src/app/home/home-toolbar/home-toolbar.component.html"),
            styles: [__webpack_require__("../../../../../src/app/home/home-toolbar/home-toolbar.component.css")]
        }),
        __metadata("design:paramtypes", [__WEBPACK_IMPORTED_MODULE_1__services_data_service__["a" /* DataService */],
            __WEBPACK_IMPORTED_MODULE_2__services_button_click_service__["a" /* ButtonClickService */],
            __WEBPACK_IMPORTED_MODULE_3__services_gallery_service__["a" /* GalleryService */],
            __WEBPACK_IMPORTED_MODULE_4__angular_router__["b" /* Router */]])
    ], HomeToolbarComponent);
    return HomeToolbarComponent;
}());



/***/ }),

/***/ "../../../../../src/app/image/image-add/image-add.component.css":
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__("../../../../css-loader/lib/css-base.js")(false);
// imports


// module
exports.push([module.i, ".uploaded-image-list li {\n    padding: 5px 10px;\n}\n\n.uploaded-image-list li img {\n    padding-right: 10px;\n}", ""]);

// exports


/*** EXPORTS FROM exports-loader ***/
module.exports = module.exports.toString();

/***/ }),

/***/ "../../../../../src/app/image/image-add/image-add.component.html":
/***/ (function(module, exports) {

module.exports = "<div class=\"modal fade\" id=\"add-modal\">\n\t<div class=\"modal-dialog\">\n\t\t<div class=\"modal-content\">\n\t\t\t<div class=\"modal-header\">\n\t\t\t\t<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>\n\t\t\t\t<h4 class=\"modal-title\">Add image</h4>\n\t\t\t</div>\n\t\t\t<form action=\"\" method=\"post\" class=\"form-horizontal\">\n\t\t\t\t<div class=\"modal-body\">\n\n\t\t\t\t\t<div class=\"form-group\">\n\t\t\t\t\t\t<label for=\"inputImageDescription\" class=\"col-sm-2 control-label\">Description</label>\n\t\t\t\t\t\t<div class=\"col-sm-10\">\n\t\t\t\t\t\t\t<textarea class=\"form-control\" name=\"inputImageDescription\" id=\"inputImageDescription\" placeholder=\"Edit...\" [(ngModel)]=\"description\"></textarea>\n\t\t\t\t\t\t</div>\n\t\t\t\t\t</div>\n\n\t\t\t\t\t<div class=\"form-group\">\n\t\t\t\t\t\t<label for=\"inputImageTags\" class=\"col-sm-2 control-label\">Tags</label>\n\t\t\t\t\t\t<div class=\"col-sm-10\">\n\t\t\t\t\t\t\t<select class=\"form-control\" name=\"inputImageTags[]\" id=\"inputImageTags\" style=\"width: 100%\" multiple>\n\t\t\t\t\t\t\t\t<option *ngFor=\"let tag of tagList\" value=\"{{tag.id}}\" selected=\"selected\">{{tag.name}}</option>\n\t\t\t\t\t\t\t</select>\n\t\t\t\t\t\t</div>\n\t\t\t\t\t</div>\n\n\t\t\t\t\t<div class=\"form-group\">\n\t\t\t\t\t\t<label for=\"inputImageTags\" class=\"col-sm-2 control-label\">Image</label>\n\t\t\t\t\t\t<div class=\"col-sm-10\">\n\t\t\t\t\t\t\t<p-fileUpload url=\"/api/upload\" name=\"myfile[]\" accept=\"image/*\" auto=\"auto\" (onUpload)=\"onUpload($event)\" multiple=\"multiple\">\n\t\t\t\t\t\t\t\t<ng-template pTemplate=\"content\">\n\t\t\t\t\t\t\t\t\t<ul *ngIf=\"uploadedFiles.length\" class=\"list-unstyled uploaded-image-list\">\n\t\t\t\t\t\t\t\t\t\t<li *ngFor=\"let file of uploadedFiles\">\n\t\t\t\t\t\t\t\t\t\t\t<img width=\"50\" src=\"/image/uploaded/{{file.hash}}\">\n\t\t\t\t\t\t\t\t\t\t\t{{file.name}} - {{file.size}} bytes\n\t\t\t\t\t\t\t\t\t\t\t<a href=\"#\" (click)=\"fileDelete($event, file)\">\n\t\t\t\t\t\t\t\t\t\t\t\t<span class=\"glyphicon glyphicon-trash\"></span>\n\t\t\t\t\t\t\t\t\t\t\t</a>\n\t\t\t\t\t\t\t\t\t\t</li>\n\t\t\t\t\t\t\t\t\t</ul>\n\t\t\t\t\t\t\t\t</ng-template>\n\t\t\t\t\t\t\t</p-fileUpload>\n\t\t\t\t\t\t</div>\n\t\t\t\t\t</div>\n\t\t\t\t</div>\n\n\t\t\t\t<div class=\"modal-footer\">\n\t\t\t\t\t<button type=\"button\" class=\"btn btn-default\" data-dismiss=\"modal\">Close</button>\n\t\t\t\t\t<input (click)=\"onSubmit()\" type=\"submit\" class=\"btn btn-primary\" value=\"Save changes\">\n\t\t\t\t</div>\n\t\t\t</form>\n\t\t</div><!-- /.modal-content -->\n\t</div><!-- /.modal-dialog -->\n</div><!-- /.modal -->\n"

/***/ }),

/***/ "../../../../../src/app/image/image-add/image-add.component.ts":
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "a", function() { return ImageAddComponent; });
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__angular_core__ = __webpack_require__("../../../core/esm5/core.js");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__services_button_click_service__ = __webpack_require__("../../../../../src/app/services/button-click.service.ts");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_2__angular_router__ = __webpack_require__("../../../router/esm5/router.js");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_3__services_image_service__ = __webpack_require__("../../../../../src/app/services/image_service.ts");
var __decorate = (this && this.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};
var __metadata = (this && this.__metadata) || function (k, v) {
    if (typeof Reflect === "object" && typeof Reflect.metadata === "function") return Reflect.metadata(k, v);
};




var ImageAddComponent = (function () {
    function ImageAddComponent(buttonClickService, imageService, router) {
        var _this = this;
        this.buttonClickService = buttonClickService;
        this.imageService = imageService;
        this.router = router;
        this.filename = '';
        this.description = '';
        this.tagList = [];
        this.uploadedFiles = [];
        this.subscription = this.buttonClickService.notifyObservable$.subscribe(function (data) {
            if (data.name !== 'imageAddClick')
                return;
            _this.reset();
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
    ImageAddComponent.prototype.reset = function () {
        this.description = '';
        this.tagList = [];
        for (var _i = 0, _a = this.gallery.tag_list; _i < _a.length; _i++) {
            var tag = _a[_i];
            this.tagList.push({ name: tag.name, id: '' + tag.id });
        }
    };
    ImageAddComponent.prototype.onSubmit = function () {
        var _this = this;
        // Select2 isn't synchronising so we have to get the selections manually
        var tagData = $('#inputImageTags').select2('data');
        var tags = [];
        for (var _i = 0, tagData_1 = tagData; _i < tagData_1.length; _i++) {
            var tag = tagData_1[_i];
            tags.push(tag.id);
        }
        var files = this.uploadedFiles.map(function (file) {
            return file.hash;
        });
        this.imageService.SubmitImages({
            id: 0,
            gallery_id: this.gallery.id,
            description: this.description,
            tags: tags,
            fileHashes: files
        }).subscribe(function (data) {
            var options = {
                message: 'Image saved',
                container: '#editSuccessContainer',
                duration: 5000
            };
            $.meow(options);
            $('#inputImageTags').children().remove();
            $('#add-modal').modal('hide');
            if (files.length === 1)
                _this.router.navigate(['/image/' + _this.gallery.id + '/' + data.message]);
        });
    };
    ImageAddComponent.prototype.ngOnInit = function () {
    };
    ImageAddComponent.prototype.onUpload = function (event) {
        var response = JSON.parse(event.xhr.response);
        for (var _i = 0, _a = event.files; _i < _a.length; _i++) {
            var file = _a[_i];
            var hash = '';
            for (var _b = 0, response_1 = response; _b < response_1.length; _b++) {
                var r = response_1[_b];
                if (r.filename === file.name)
                    hash = r.hash;
            }
            file.hash = hash;
            this.uploadedFiles.push(file);
        }
    };
    ImageAddComponent.prototype.fileDelete = function ($event, file) {
        $event.preventDefault();
        console.log(file);
        var fileIndex = -1;
        for (var _i = 0, _a = this.uploadedFiles.map(function (item, index) { return ({ item: item, index: index }); }); _i < _a.length; _i++) {
            var _b = _a[_i], item = _b.item, index = _b.index;
            if (item.hash === file.hash)
                fileIndex = index;
        }
        if (fileIndex > -1)
            this.uploadedFiles.splice(fileIndex, 1);
    };
    __decorate([
        Object(__WEBPACK_IMPORTED_MODULE_0__angular_core__["Input"])(),
        __metadata("design:type", Object)
    ], ImageAddComponent.prototype, "gallery", void 0);
    ImageAddComponent = __decorate([
        Object(__WEBPACK_IMPORTED_MODULE_0__angular_core__["Component"])({
            selector: 'image-add',
            template: __webpack_require__("../../../../../src/app/image/image-add/image-add.component.html"),
            styles: [__webpack_require__("../../../../../src/app/image/image-add/image-add.component.css")]
        }),
        __metadata("design:paramtypes", [__WEBPACK_IMPORTED_MODULE_1__services_button_click_service__["a" /* ButtonClickService */],
            __WEBPACK_IMPORTED_MODULE_3__services_image_service__["a" /* ImageService */],
            __WEBPACK_IMPORTED_MODULE_2__angular_router__["b" /* Router */]])
    ], ImageAddComponent);
    return ImageAddComponent;
}());



/***/ }),

/***/ "../../../../../src/app/image/image-edit/image-edit.component.css":
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__("../../../../css-loader/lib/css-base.js")(false);
// imports


// module
exports.push([module.i, "", ""]);

// exports


/*** EXPORTS FROM exports-loader ***/
module.exports = module.exports.toString();

/***/ }),

/***/ "../../../../../src/app/image/image-edit/image-edit.component.html":
/***/ (function(module, exports) {

module.exports = "<div class=\"modal fade\" id=\"edit-modal\">\n\t<div class=\"modal-dialog\">\n\t\t<div class=\"modal-content\">\n\t\t\t<div class=\"modal-header\">\n\t\t\t\t<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>\n\t\t\t\t<h4 class=\"modal-title\">Edit image</h4>\n\t\t\t</div>\n\t\t\t<form action=\"\" method=\"post\" class=\"form-horizontal\">\n\t\t\t\t<div class=\"modal-body\">\n\n\t\t\t\t\t<div class=\"form-group\">\n\t\t\t\t\t\t<label for=\"inputImageDescription\" class=\"col-sm-2 control-label\">Description</label>\n\t\t\t\t\t\t<div class=\"col-sm-10\">\n\t\t\t\t\t\t\t<textarea class=\"form-control\" name=\"inputImageDescription\" id=\"inputImageDescription\" placeholder=\"Edit...\" [(ngModel)]=\"description\"></textarea>\n\t\t\t\t\t\t</div>\n\t\t\t\t\t</div>\n\n\t\t\t\t\t<div class=\"form-group\">\n\t\t\t\t\t\t<label for=\"inputImageTags\" class=\"col-sm-2 control-label\">Tags</label>\n\t\t\t\t\t\t<div class=\"col-sm-10\">\n\t\t\t\t\t\t\t<select class=\"form-control\" name=\"inputImageTags[]\" id=\"inputImageTags\" style=\"width: 100%\" multiple>\n\t\t\t\t\t\t\t\t<option *ngFor=\"let tag of tagList\" value=\"{{tag.id}}\" selected=\"selected\">{{tag.name}}</option>\n\t\t\t\t\t\t\t</select>\n\t\t\t\t\t\t</div>\n\t\t\t\t\t</div>\n\t\t\t\t</div>\n\n\t\t\t\t<div class=\"modal-footer\">\n\t\t\t\t\t<button type=\"button\" class=\"btn btn-default\" data-dismiss=\"modal\">Close</button>\n\t\t\t\t\t<input (click)=\"onSubmit()\" type=\"submit\" class=\"btn btn-primary\" value=\"Save changes\">\n\t\t\t\t</div>\n\t\t\t</form>\n\t\t</div><!-- /.modal-content -->\n\t</div><!-- /.modal-dialog -->\n</div><!-- /.modal -->\n"

/***/ }),

/***/ "../../../../../src/app/image/image-edit/image-edit.component.ts":
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "a", function() { return ImageEditComponent; });
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__angular_core__ = __webpack_require__("../../../core/esm5/core.js");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__services_button_click_service__ = __webpack_require__("../../../../../src/app/services/button-click.service.ts");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_2__angular_router__ = __webpack_require__("../../../router/esm5/router.js");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_3__services_image_service__ = __webpack_require__("../../../../../src/app/services/image_service.ts");
var __decorate = (this && this.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};
var __metadata = (this && this.__metadata) || function (k, v) {
    if (typeof Reflect === "object" && typeof Reflect.metadata === "function") return Reflect.metadata(k, v);
};




var ImageEditComponent = (function () {
    function ImageEditComponent(buttonClickService, imageService, router) {
        var _this = this;
        this.buttonClickService = buttonClickService;
        this.imageService = imageService;
        this.router = router;
        this.id = '0';
        this.tagList = [];
        this.description = '';
        this.subscription = this.buttonClickService.notifyObservable$.subscribe(function (data) {
            if (data.name !== 'imageEditClick')
                return;
            _this.reset();
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
    ImageEditComponent.prototype.reset = function () {
        this.id = '' + this.image.id;
        this.description = this.image.description;
        this.tagList = [];
        var tags = [];
        for (var _i = 0, _a = this.image.tag_list; _i < _a.length; _i++) {
            var tag = _a[_i];
            this.tagList.push({ name: tag.name, id: '' + tag.id });
            tags.push('' + tag.id);
        }
        $('#inputImageTags').val(tags);
    };
    ImageEditComponent.prototype.onSubmit = function () {
        // Select2 isn't synchronising so we have to get the selections manually
        var tagData = $('#inputImageTags').select2('data');
        var tags = [];
        for (var _i = 0, tagData_1 = tagData; _i < tagData_1.length; _i++) {
            var tag = tagData_1[_i];
            tags.push(tag.id);
        }
        this.imageService.SubmitImages({
            id: this.image.id,
            gallery_id: this.image.gallery_id,
            description: this.description,
            tags: tags,
        }).subscribe(function (data) {
            var options = {
                message: 'Image saved',
                container: '#editSuccessContainer',
                duration: 5000
            };
            $.meow(options);
            $('#inputImageTags').children().remove();
            $('#edit-modal').modal('hide');
        });
    };
    ImageEditComponent.prototype.ngOnInit = function () {
    };
    __decorate([
        Object(__WEBPACK_IMPORTED_MODULE_0__angular_core__["Input"])(),
        __metadata("design:type", Object)
    ], ImageEditComponent.prototype, "image", void 0);
    ImageEditComponent = __decorate([
        Object(__WEBPACK_IMPORTED_MODULE_0__angular_core__["Component"])({
            selector: 'image-edit',
            template: __webpack_require__("../../../../../src/app/image/image-edit/image-edit.component.html"),
            styles: [__webpack_require__("../../../../../src/app/image/image-edit/image-edit.component.css")]
        }),
        __metadata("design:paramtypes", [__WEBPACK_IMPORTED_MODULE_1__services_button_click_service__["a" /* ButtonClickService */],
            __WEBPACK_IMPORTED_MODULE_3__services_image_service__["a" /* ImageService */],
            __WEBPACK_IMPORTED_MODULE_2__angular_router__["b" /* Router */]])
    ], ImageEditComponent);
    return ImageEditComponent;
}());



/***/ }),

/***/ "../../../../../src/app/image/image-info/image-info.component.css":
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__("../../../../css-loader/lib/css-base.js")(false);
// imports


// module
exports.push([module.i, ".moa-page {\n    width: 1140px;\n}\n\n.image-container {\n    text-align: center;\n}\n\n.image-lightbox-link {\n    text-align: center;\n    cursor: pointer;\n}", ""]);

// exports


/*** EXPORTS FROM exports-loader ***/
module.exports = module.exports.toString();

/***/ }),

/***/ "../../../../../src/app/image/image-info/image-info.component.html":
/***/ (function(module, exports) {

module.exports = "<div class=\"moa-page\">\n\t<p>\n\t\t{{image.description}}\n\t</p>\n\t<div class=\"image-container\">\n\t\t<a [href]=\"getFullImageUrl()\" ng-box [title]=\"image.filename\" class=\"image-lightbox-link\">\n\t\t\t<img src=\"{{image.image_src}}\">\n\t\t</a>\n\t</div>\n\t<br>\n\t<div class=\"row\">\n\t\t<a [href]=\"getFullImageUrl()\" target=\"_blank\" class=\"btn btn-info col-md-2 col-md-offset-5\">\n\t\t\t<span class=\"glyphicon glyphicon-new-window pull-left\"></span> Open in new tab\n\t\t</a>\n\t</div>\n</div>\n<ngbox></ngbox>"

/***/ }),

/***/ "../../../../../src/app/image/image-info/image-info.component.ts":
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "a", function() { return ImageInfoComponent; });
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__angular_core__ = __webpack_require__("../../../core/esm5/core.js");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__services_data_service__ = __webpack_require__("../../../../../src/app/services/data.service.ts");
var __decorate = (this && this.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};
var __metadata = (this && this.__metadata) || function (k, v) {
    if (typeof Reflect === "object" && typeof Reflect.metadata === "function") return Reflect.metadata(k, v);
};


var ImageInfoComponent = (function () {
    function ImageInfoComponent(service) {
        var _this = this;
        this.service = service;
        this.image = {
            id: 0,
            image_src: '',
            description: '',
            format: 'jpg',
            filename: ''
        };
        this.imageFullUrl = this.getFullImageUrl();
        this.observer = service.getImageObserver().subscribe(function (data) {
            _this.image = data;
            _this.imageFullUrl = _this.getFullImageUrl();
        });
    }
    ImageInfoComponent.prototype.ngOnDestroy = function () {
        this.observer.unsubscribe();
    };
    ImageInfoComponent.prototype.getFullImageUrl = function () {
        return '/image/' + this.image.id + '/' + this.image.filename;
    };
    ImageInfoComponent = __decorate([
        Object(__WEBPACK_IMPORTED_MODULE_0__angular_core__["Component"])({
            selector: 'image-info',
            template: __webpack_require__("../../../../../src/app/image/image-info/image-info.component.html"),
            styles: [__webpack_require__("../../../../../src/app/image/image-info/image-info.component.css")]
        }),
        __metadata("design:paramtypes", [__WEBPACK_IMPORTED_MODULE_1__services_data_service__["a" /* DataService */]])
    ], ImageInfoComponent);
    return ImageInfoComponent;
}());



/***/ }),

/***/ "../../../../../src/app/image/image-list/image-list.component.css":
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__("../../../../css-loader/lib/css-base.js")(false);
// imports


// module
exports.push([module.i, ".thumbnail {\n    float: left;\n    margin-bottom: 0;\n}", ""]);

// exports


/*** EXPORTS FROM exports-loader ***/
module.exports = module.exports.toString();

/***/ }),

/***/ "../../../../../src/app/image/image-list/image-list.component.html":
/***/ (function(module, exports) {

module.exports = "<ul class=\"list-unstyled\">\n\t<li *ngFor=\"let image of images\" class=\"thumbnail\">\n\t\t<image-thumb [image]=\"image\" [gallery_id]=\"gallery.id\">\n\t\t</image-thumb>\n\t</li>\n</ul>\n"

/***/ }),

/***/ "../../../../../src/app/image/image-list/image-list.component.ts":
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "a", function() { return ImageListComponent; });
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__angular_core__ = __webpack_require__("../../../core/esm5/core.js");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__services_data_service__ = __webpack_require__("../../../../../src/app/services/data.service.ts");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_2__services_thumbnail_service__ = __webpack_require__("../../../../../src/app/services/thumbnail.service.ts");
var __decorate = (this && this.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};
var __metadata = (this && this.__metadata) || function (k, v) {
    if (typeof Reflect === "object" && typeof Reflect.metadata === "function") return Reflect.metadata(k, v);
};



var ImageListComponent = (function () {
    function ImageListComponent(service, thumbService) {
        var _this = this;
        this.service = service;
        this.thumbService = thumbService;
        this.imagesObserver = service.getImagesObserver().subscribe(function (data) {
            _this.images = data;
            _this.checkThumbs();
        });
        this.galleryObserver = service.getGalleryObserver().subscribe(function (data) {
            _this.gallery = data;
        });
    }
    ImageListComponent_1 = ImageListComponent;
    ImageListComponent.prototype.ngOnInit = function () {
        this.checkThumbs();
    };
    ImageListComponent.prototype.checkThumbs = function () {
        var imageWidths = [];
        var totalWidth = 0;
        if (this.thumbSub !== undefined)
            this.thumbSub.unsubscribe();
        var toGenerate = [];
        if (this.images !== undefined) {
            for (var _i = 0, _a = this.images; _i < _a.length; _i++) {
                var image = _a[_i];
                if (image.isGenerating) {
                    toGenerate.push(parseInt(image.id));
                }
                var width = image.width * (Number(ImageListComponent_1.TARGET_HEIGHT) / image.height);
                imageWidths.push(width);
                totalWidth += width;
            }
            if (toGenerate.length > 0)
                this.getThumbs(toGenerate);
            var maxWidth = Number(ImageListComponent_1.GALLERY_WIDTH) * 1.2;
            var rows = [];
            var row = {
                width: 0,
                images: 0
            };
            var i = 0;
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
            for (var _b = 0, rows_1 = rows; _b < rows_1.length; _b++) {
                var row_1 = rows_1[_b];
                var scaleFactor = Number(ImageListComponent_1.GALLERY_WIDTH) / row_1.width;
                for (var j = 0; j < row_1.images; j++) {
                    this.images[i].displayWidth = Math.floor(imageWidths[i] * scaleFactor);
                    this.images[i].displayHeight = Math.floor(Number(ImageListComponent_1.TARGET_HEIGHT) * scaleFactor);
                    i++;
                }
            }
        }
    };
    ImageListComponent.prototype.getThumbs = function (toGenerate) {
        var _this = this;
        this.thumbSub = this.thumbService.getStatus(toGenerate).subscribe(function (data) {
            var nextBatch = [];
            for (var _i = 0, toGenerate_1 = toGenerate; _i < toGenerate_1.length; _i++) {
                var image = toGenerate_1[_i];
                var found = false;
                for (var _a = 0, data_1 = data; _a < data_1.length; _a++) {
                    var notDoneYet = data_1[_a];
                    if (image == notDoneYet)
                        found = true;
                }
                if (!found) {
                    for (var _b = 0, _c = _this.images; _b < _c.length; _b++) {
                        var i = _c[_b];
                        if (image == i.id)
                            i.isGenerating = false;
                    }
                }
                else {
                    nextBatch.push(image);
                }
            }
            _this.thumbSub.unsubscribe();
            if (nextBatch.length > 0) {
                setTimeout(function () {
                    _this.getThumbs(nextBatch);
                }, 200);
            }
        });
    };
    ImageListComponent.prototype.ngOnDestroy = function () {
        this.imagesObserver.unsubscribe();
        this.galleryObserver.unsubscribe();
    };
    ImageListComponent.TARGET_HEIGHT = 300;
    ImageListComponent.GALLERY_WIDTH = 1140;
    ImageListComponent = ImageListComponent_1 = __decorate([
        Object(__WEBPACK_IMPORTED_MODULE_0__angular_core__["Component"])({
            selector: 'image-list',
            template: __webpack_require__("../../../../../src/app/image/image-list/image-list.component.html"),
            styles: [__webpack_require__("../../../../../src/app/image/image-list/image-list.component.css")]
        }),
        __metadata("design:paramtypes", [__WEBPACK_IMPORTED_MODULE_1__services_data_service__["a" /* DataService */],
            __WEBPACK_IMPORTED_MODULE_2__services_thumbnail_service__["a" /* ThumbnailService */]])
    ], ImageListComponent);
    return ImageListComponent;
    var ImageListComponent_1;
}());



/***/ }),

/***/ "../../../../../src/app/image/image-thumb/image-thumb.component.css":
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__("../../../../css-loader/lib/css-base.js")(false);
// imports


// module
exports.push([module.i, ".thumbnail-generating {\n    width: 64px;\n    height: 64px;\n    margin: 62px 109px;\n}\n\n.thumbnail-image-container {\n    overflow: hidden;\n    text-align: center;\n    background-color: rgba(0, 0, 0, 0.05);\n}", ""]);

// exports


/*** EXPORTS FROM exports-loader ***/
module.exports = module.exports.toString();

/***/ }),

/***/ "../../../../../src/app/image/image-thumb/image-thumb.component.html":
/***/ (function(module, exports) {

module.exports = "<div>\n\t<a [routerLink]=\"[getLink()]\">\n\t\t<img *ngIf=\"!image.isGenerating && image.displayWidth <= 450 && image.displayHeight <= 300\" src=\"/image/thumb/{{image.id}}.jpg\" [ngStyle]=\"{width: (image.displayWidth - 10) + 'px', height: image.displayHeight + 'px'}\">\n\t\t<img *ngIf=\"!image.isGenerating && (image.displayWidth > 450 || image.displayHeight > 300)\" src=\"/image/thumb/{{image.id}}-w.jpg\" [ngStyle]=\"{width: (image.displayWidth - 10) + 'px', height: image.displayHeight + 'px'}\">\n\t\t<img *ngIf=\"image.isGenerating\" src=\"/media/spinner.svg\" class=\"thumbnail-generating\">\n\t\t<span>{{image.filename}}</span>\n\t</a>\n</div>"

/***/ }),

/***/ "../../../../../src/app/image/image-thumb/image-thumb.component.ts":
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "a", function() { return ImageThumbComponent; });
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__angular_core__ = __webpack_require__("../../../core/esm5/core.js");
var __decorate = (this && this.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};
var __metadata = (this && this.__metadata) || function (k, v) {
    if (typeof Reflect === "object" && typeof Reflect.metadata === "function") return Reflect.metadata(k, v);
};

var ImageThumbComponent = (function () {
    function ImageThumbComponent() {
    }
    ImageThumbComponent.prototype.getLink = function () {
        return '/image/' + this.gallery_id + '/' + this.image.id;
    };
    __decorate([
        Object(__WEBPACK_IMPORTED_MODULE_0__angular_core__["Input"])(),
        __metadata("design:type", Object)
    ], ImageThumbComponent.prototype, "image", void 0);
    __decorate([
        Object(__WEBPACK_IMPORTED_MODULE_0__angular_core__["Input"])(),
        __metadata("design:type", Object)
    ], ImageThumbComponent.prototype, "gallery_id", void 0);
    ImageThumbComponent = __decorate([
        Object(__WEBPACK_IMPORTED_MODULE_0__angular_core__["Component"])({
            selector: 'image-thumb',
            template: __webpack_require__("../../../../../src/app/image/image-thumb/image-thumb.component.html"),
            styles: [__webpack_require__("../../../../../src/app/image/image-thumb/image-thumb.component.css")]
        }),
        __metadata("design:paramtypes", [])
    ], ImageThumbComponent);
    return ImageThumbComponent;
}());



/***/ }),

/***/ "../../../../../src/app/image/image-toolbar/image-toolbar.component.css":
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__("../../../../css-loader/lib/css-base.js")(false);
// imports


// module
exports.push([module.i, "", ""]);

// exports


/*** EXPORTS FROM exports-loader ***/
module.exports = module.exports.toString();

/***/ }),

/***/ "../../../../../src/app/image/image-toolbar/image-toolbar.component.html":
/***/ (function(module, exports) {

module.exports = "<image-edit [image]=\"image\"></image-edit>\n\n<div class=\"row\">\n\t<div class=\"pull-right\">\n\t\t<div class=\"btn-group\" role=\"group\" aria-label=\"...\">\n\t\t\t<button type=\"button\" (click)=\"onEditClick()\" class=\"btn btn-default\" id=\"imageEdit\" title=\"Edit image\" data-toggle=\"tooltip\"><span class=\"glyphicon glyphicon-pencil\"></span></button>\n\t\t\t<button type=\"button\" (click)=\"onDeleteClick()\" class=\"btn btn-default\" id=\"imageDelete\" title=\"Delete image\" data-toggle=\"tooltip\"><span class=\"glyphicon glyphicon-trash\"></span></button>\n\t\t</div>\n\t</div>\n</div>"

/***/ }),

/***/ "../../../../../src/app/image/image-toolbar/image-toolbar.component.ts":
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "a", function() { return ImageToolbarComponent; });
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__angular_core__ = __webpack_require__("../../../core/esm5/core.js");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__services_button_click_service__ = __webpack_require__("../../../../../src/app/services/button-click.service.ts");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_2__services_data_service__ = __webpack_require__("../../../../../src/app/services/data.service.ts");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_3__angular_router__ = __webpack_require__("../../../router/esm5/router.js");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_4__services_image_service__ = __webpack_require__("../../../../../src/app/services/image_service.ts");
var __decorate = (this && this.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};
var __metadata = (this && this.__metadata) || function (k, v) {
    if (typeof Reflect === "object" && typeof Reflect.metadata === "function") return Reflect.metadata(k, v);
};





var ImageToolbarComponent = (function () {
    function ImageToolbarComponent(dataService, buttonClickService, imageService, router) {
        var _this = this;
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
        this.observer = dataService.getImageObserver().subscribe(function (data) {
            _this.image = data;
        });
    }
    ImageToolbarComponent.prototype.onEditClick = function () {
        this.buttonClickService.trigger('imageEditClick');
    };
    ImageToolbarComponent.prototype.onDeleteClick = function () {
        var _this = this;
        if (confirm('Delete this image?')) {
            this.imageService.DeleteImage(this.image.id).subscribe(function (next) {
                var options = {
                    message: 'Image deleted',
                    container: '#editSuccessContainer',
                    duration: 5000
                };
                $.meow(options);
                _this.router.navigate(['/gallery/' + _this.image.gallery_id]);
            });
        }
    };
    ImageToolbarComponent.prototype.ngOnDestroy = function () {
        this.observer.unsubscribe();
    };
    ImageToolbarComponent = __decorate([
        Object(__WEBPACK_IMPORTED_MODULE_0__angular_core__["Component"])({
            selector: 'image-toolbar',
            template: __webpack_require__("../../../../../src/app/image/image-toolbar/image-toolbar.component.html"),
            styles: [__webpack_require__("../../../../../src/app/image/image-toolbar/image-toolbar.component.css")]
        }),
        __metadata("design:paramtypes", [__WEBPACK_IMPORTED_MODULE_2__services_data_service__["a" /* DataService */],
            __WEBPACK_IMPORTED_MODULE_1__services_button_click_service__["a" /* ButtonClickService */],
            __WEBPACK_IMPORTED_MODULE_4__services_image_service__["a" /* ImageService */],
            __WEBPACK_IMPORTED_MODULE_3__angular_router__["b" /* Router */]])
    ], ImageToolbarComponent);
    return ImageToolbarComponent;
}());



/***/ }),

/***/ "../../../../../src/app/models/gallery.model.ts":
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "a", function() { return Gallery; });
var Gallery = (function () {
    function Gallery(id, name, thumbUrl) {
        this.id = id;
        this.name = name;
        this.thumbUrl = thumbUrl;
    }
    return Gallery;
}());



/***/ }),

/***/ "../../../../../src/app/ngbox/ngbox.component.ts":
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "a", function() { return NgBoxComponent; });
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__angular_core__ = __webpack_require__("../../../core/esm5/core.js");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__ngbox_service__ = __webpack_require__("../../../../../src/app/ngbox/ngbox.service.ts");
var __decorate = (this && this.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};
var __metadata = (this && this.__metadata) || function (k, v) {
    if (typeof Reflect === "object" && typeof Reflect.metadata === "function") return Reflect.metadata(k, v);
};


var NgBoxComponent = (function () {
    function NgBoxComponent(ngBox) {
        this.ngBox = ngBox;
        this.showMore = new __WEBPACK_IMPORTED_MODULE_0__angular_core__["EventEmitter"]();
    }
    NgBoxComponent.prototype.ngDoCheck = function () {
        if (this.ngBox.open === true && this.elementView === undefined) {
            this.checkInterval();
        }
    };
    NgBoxComponent.prototype.closeOutside = function ($event) {
        if ($event.target.getAttribute('id') === 'ngBoxContent' || $event.target.getAttribute('id') === 'ngBoxWrapper') {
            this.closeNgBox();
        }
    };
    NgBoxComponent.prototype.checkInterval = function () {
        var _this = this;
        var t = setInterval(function () {
            if (_this.elementView && _this.elementButtons) {
                _this.resize();
                // Stop Loading on frames
                if (_this.ngBox.current.type === 2 || _this.ngBox.current.type === 3 || _this.ngBox.current.type === 4) {
                    _this.ngBox.loading = false;
                }
                clearInterval(t);
            }
        }, 10);
    };
    NgBoxComponent.prototype.closeNgBox = function () {
        this.ngBox.open = false;
    };
    NgBoxComponent.prototype.elementExist = function () {
        if (this.elementView !== undefined) {
            return true;
        }
        return false;
    };
    NgBoxComponent.prototype.resize = function () {
        // Resize big images
        if (this.elementView && this.elementButtons) {
            var currentWidth = this.calcPercent(this.ngBox.current.width, window.innerWidth);
            var currentHeight = this.calcPercent(this.ngBox.current.height, window.innerHeight);
            var realWidth = this.elementView.nativeElement.naturalWidth ?
                this.elementView.nativeElement.naturalWidth : currentWidth;
            var realHeight = this.elementView.nativeElement.naturalHeight ?
                this.elementView.nativeElement.naturalHeight : currentHeight;
            var maxWidth = Math.min((window.innerWidth - 70), currentWidth ? currentWidth : realWidth);
            var maxHeight = Math.min((window.innerHeight - 60), currentHeight ? currentHeight : realHeight);
            var ratio = Math.min(maxWidth / realWidth, maxHeight / realHeight);
            this.elementView.nativeElement.width = realWidth * ratio;
            this.elementView.nativeElement.height = realHeight * ratio;
            this.elementButtons.nativeElement.style.width = this.elementView.nativeElement.offsetWidth + 'px';
            // Calculate top padding
            this.offsetHeight = (window.innerHeight - 40 - this.elementView.nativeElement.offsetHeight) / 2;
            if (this.offsetHeight < 0) {
                this.offsetHeight = 0;
            }
        }
    };
    NgBoxComponent.prototype.checkKeyPress = function (event) {
        if (event.keyCode === 39) {
            this.nextNgBox();
        }
        else if (event.keyCode === 37) {
            this.previousNgBox();
        }
        else if (event.keyCode === 27) {
            this.closeNgBox();
        }
    };
    NgBoxComponent.prototype.calcPercent = function (value, of) {
        if (value !== undefined && value.toString().search('%') >= 0) {
            return of * parseInt(value.toString(), 0) / 100;
        }
        return value;
    };
    NgBoxComponent.prototype.getHasGroup = function () {
        return this.ngBox.current.group !== undefined;
    };
    NgBoxComponent.prototype.getCount = function () {
        var _this = this;
        return this.ngBox.images.filter(function (image) { return image.group === _this.ngBox.current.group; }).length;
    };
    NgBoxComponent.prototype.getCurrentIndex = function () {
        var _this = this;
        var currentGroup = this.ngBox.images.filter(function (image) { return image.group === _this.ngBox.current.group; });
        return currentGroup.map(function (e) {
            return e.id;
        }).indexOf(this.ngBox.current.id) + 1;
    };
    NgBoxComponent.prototype.nextNgBox = function () {
        var _this = this;
        if (this.ngBox.current.group === undefined) {
            return false;
        }
        this.ngBox.loading = true;
        var currentGroup = this.ngBox.images.filter(function (image) { return image.group === _this.ngBox.current.group; });
        var pos = currentGroup.map(function (e) {
            return e.id;
        }).indexOf(this.ngBox.current.id);
        if (pos >= currentGroup.length - 1) {
            this.ngBox.current = currentGroup[0];
        }
        else {
            this.ngBox.current = currentGroup[pos + 1];
        }
        this.checkInterval();
    };
    NgBoxComponent.prototype.previousNgBox = function () {
        var _this = this;
        if (this.ngBox.current.group === undefined) {
            return false;
        }
        this.ngBox.loading = true;
        var currentGroup = this.ngBox.images.filter(function (image) { return image.group === _this.ngBox.current.group; });
        var pos = currentGroup.map(function (e) {
            return e.id;
        }).indexOf(this.ngBox.current.id);
        if (pos === 0) {
            pos = currentGroup.length;
        }
        this.ngBox.current = currentGroup[pos - 1];
        this.checkInterval();
    };
    NgBoxComponent.prototype.isLoaded = function () {
        if (this.ngBox.current.type === 1) {
            this.ngBox.loading = false;
        }
        this.checkInterval();
    };
    __decorate([
        Object(__WEBPACK_IMPORTED_MODULE_0__angular_core__["Input"])(),
        __metadata("design:type", Object)
    ], NgBoxComponent.prototype, "data", void 0);
    __decorate([
        Object(__WEBPACK_IMPORTED_MODULE_0__angular_core__["Output"])(),
        __metadata("design:type", Object)
    ], NgBoxComponent.prototype, "showMore", void 0);
    __decorate([
        Object(__WEBPACK_IMPORTED_MODULE_0__angular_core__["ViewChild"])('ngBoxContent'),
        __metadata("design:type", __WEBPACK_IMPORTED_MODULE_0__angular_core__["ElementRef"])
    ], NgBoxComponent.prototype, "elementView", void 0);
    __decorate([
        Object(__WEBPACK_IMPORTED_MODULE_0__angular_core__["ViewChild"])('ngBoxButtons'),
        __metadata("design:type", __WEBPACK_IMPORTED_MODULE_0__angular_core__["ElementRef"])
    ], NgBoxComponent.prototype, "elementButtons", void 0);
    __decorate([
        Object(__WEBPACK_IMPORTED_MODULE_0__angular_core__["HostListener"])('window:resize', ['$event']),
        __metadata("design:type", Function),
        __metadata("design:paramtypes", []),
        __metadata("design:returntype", void 0)
    ], NgBoxComponent.prototype, "resize", null);
    __decorate([
        Object(__WEBPACK_IMPORTED_MODULE_0__angular_core__["HostListener"])('window:keydown', ['$event']),
        __metadata("design:type", Function),
        __metadata("design:paramtypes", [KeyboardEvent]),
        __metadata("design:returntype", void 0)
    ], NgBoxComponent.prototype, "checkKeyPress", null);
    NgBoxComponent = __decorate([
        Object(__WEBPACK_IMPORTED_MODULE_0__angular_core__["Component"])({
            selector: 'my-ngbox, ngbox',
            template: "\n        <div id=\"ngBoxLoading\" *ngIf=\"ngBox.loading\"><img src=\"data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNv\nZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9Im5vIj8+PHN2ZyB4bWxuczpzdmc9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxucz0iaHR0cD\novL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB2ZXJzaW9uPSIxLjAiIHdpZHRo\nPSIxNjBweCIgaGVpZ2h0PSIyMHB4IiB2aWV3Qm94PSIwIDAgMTI4IDE2IiB4bWw6c3BhY2U9InByZXNlcnZlIj48c2NyaXB0IHR5cGU9InRleHQvZW\nNtYXNjcmlwdCIgeGxpbms6aHJlZj0iLy9wcmVsb2FkZXJzLm5ldC9qc2NyaXB0cy9zbWlsLnVzZXIuanMiLz48cGF0aCBmaWxsPSIjZmZmZmZmIiBm\naWxsLW9wYWNpdHk9IjAuNDE5NjA3ODQzMTM3MjUiIGQ9Ik02LjQsNC44QTMuMiwzLjIsMCwxLDEsMy4yLDgsMy4yLDMuMiwwLDAsMSw2LjQsNC44Wm\n0xMi44LDBBMy4yLDMuMiwwLDEsMSwxNiw4LDMuMiwzLjIsMCwwLDEsMTkuMiw0LjhaTTMyLDQuOEEzLjIsMy4yLDAsMSwxLDI4LjgsOCwzLjIsMy4y\nLDAsMCwxLDMyLDQuOFptMTIuOCwwQTMuMiwzLjIsMCwxLDEsNDEuNiw4LDMuMiwzLjIsMCwwLDEsNDQuOCw0LjhabTEyLjgsMEEzLjIsMy4yLDAsMS\nwxLDU0LjQsOCwzLjIsMy4yLDAsMCwxLDU3LjYsNC44Wm0xMi44LDBBMy4yLDMuMiwwLDEsMSw2Ny4yLDgsMy4yLDMuMiwwLDAsMSw3MC40LDQuOFpt\nMTIuOCwwQTMuMiwzLjIsMCwxLDEsODAsOCwzLjIsMy4yLDAsMCwxLDgzLjIsNC44Wk05Niw0LjhBMy4yLDMuMiwwLDEsMSw5Mi44LDgsMy4yLDMuMi\nwwLDAsMSw5Niw0LjhabTEyLjgsMEEzLjIsMy4yLDAsMSwxLDEwNS42LDgsMy4yLDMuMiwwLDAsMSwxMDguOCw0LjhabTEyLjgsMEEzLjIsMy4yLDAs\nMSwxLDExOC40LDgsMy4yLDMuMiwwLDAsMSwxMjEuNiw0LjhaIi8+PGc+PHBhdGggZmlsbD0iI2ZmZmZmZiIgZmlsbC1vcGFjaXR5PSIxIiBkPSJNLT\nQyLjcsMy44NEE0LjE2LDQuMTYsMCwwLDEtMzguNTQsOGE0LjE2LDQuMTYsMCwwLDEtNC4xNiw0LjE2QTQuMTYsNC4xNiwwLDAsMS00Ni44Niw4LDQu\nMTYsNC4xNiwwLDAsMS00Mi43LDMuODRabTEyLjgtLjY0QTQuOCw0LjgsMCwwLDEtMjUuMSw4YTQuOCw0LjgsMCwwLDEtNC44LDQuOEE0LjgsNC44LD\nAsMCwxLTM0LjcsOCw0LjgsNC44LDAsMCwxLTI5LjksMy4yWm0xMi44LS42NEE1LjQ0LDUuNDQsMCwwLDEtMTEuNjYsOGE1LjQ0LDUuNDQsMCwwLDEt\nNS40NCw1LjQ0QTUuNDQsNS40NCwwLDAsMS0yMi41NCw4LDUuNDQsNS40NCwwLDAsMS0xNy4xLDIuNTZaIi8+PGFuaW1hdGVUcmFuc2Zvcm0gYXR0cm\nlidXRlTmFtZT0idHJhbnNmb3JtIiB0eXBlPSJ0cmFuc2xhdGUiIHZhbHVlcz0iMjMgMDszNiAwOzQ5IDA7NjIgMDs3NC41IDA7ODcuNSAwOzEwMCAw\nOzExMyAwOzEyNS41IDA7MTM4LjUgMDsxNTEuNSAwOzE2NC41IDA7MTc4IDAiIGNhbGNNb2RlPSJkaXNjcmV0ZSIgZHVyPSI3ODBtcyIgcmVwZWF0Q2\n91bnQ9ImluZGVmaW5pdGUiLz48L2c+PC9zdmc+Cg==\"/></div>\n        <div id=\"ngBoxWrapper\" (click)=\"closeOutside($event)\" *ngIf=\"ngBox.open\" [ngStyle]=\"{'padding-top': offsetHeight+'px'}\">\n            <div id=\"ngBoxContent\">\n                <img *ngIf=\"getHasGroup()\" class=\"left\" (click)=\"previousNgBox()\" src=\"data:image/svg+xml;base64,PD94bWwgdmVyc2lvb\nj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz4NCjwhLS0gR2VuZXJhdG9yOiBBZG9iZSBJbGx1c3RyYXRvciAxNS4xLjAsIFNWRyBFeHBvcnQgUGx1Zy1JbiAuIFNWRyB\nWZXJzaW9uOiA2LjAwIEJ1aWxkIDApICAtLT4NCjwhRE9DVFlQRSBzdmcgUFVCTElDICItLy9XM0MvL0RURCBTVkcgMS4xLy9FTiIgImh0dHA6Ly93d3cudzMub3JnL\n0dyYXBoaWNzL1NWRy8xLjEvRFREL3N2ZzExLmR0ZCI+DQo8c3ZnIHZlcnNpb249IjEuMSIgaWQ9IkxheWVyXzEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDA\nwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHg9IjBweCIgeT0iMHB4Ig0KCSB3aWR0aD0iNzBweCIgaGVpZ2h0PSIxMDBwe\nCIgdmlld0JveD0iMCAwIDcwIDEwMCIgZW5hYmxlLWJhY2tncm91bmQ9Im5ldyAwIDAgNzAgMTAwIiB4bWw6c3BhY2U9InByZXNlcnZlIj4NCjxwb2x5Z29uIGZpbGw\n9IiNGRkZGRkYiIHN0cm9rZT0iIzZCNkI2QiIgc3Ryb2tlLW1pdGVybGltaXQ9IjEwIiBwb2ludHM9IjQ1LjYsOTguNTI0IDE0LjU0NCw1MCA0NS42LDEuNDc2IDQ4L\njgwMSwzLjUyNCAxOS4wNTYsNTAgDQoJNDguODAxLDk2LjQ3NiAiLz4NCjwvc3ZnPg0K\">\n                <img *ngIf=\"getHasGroup()\" class=\"right\" (click)=\"nextNgBox()\" src=\"data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0i\nMS4wIiBlbmNvZGluZz0idXRmLTgiPz4NCjwhLS0gR2VuZXJhdG9yOiBBZG9iZSBJbGx1c3RyYXRvciAxNS4xLjAsIFNWRyBFeHBvcnQgUGx1Zy1JbiAuIFNWRyBWZX\nJzaW9uOiA2LjAwIEJ1aWxkIDApICAtLT4NCjwhRE9DVFlQRSBzdmcgUFVCTElDICItLy9XM0MvL0RURCBTVkcgMS4xLy9FTiIgImh0dHA6Ly93d3cudzMub3JnL0dy\nYXBoaWNzL1NWRy8xLjEvRFREL3N2ZzExLmR0ZCI+DQo8c3ZnIHZlcnNpb249IjEuMSIgaWQ9IkxheWVyXzEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3\nN2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHg9IjBweCIgeT0iMHB4Ig0KCSB3aWR0aD0iNzBweCIgaGVpZ2h0PSIxMDBweCIg\ndmlld0JveD0iMCAwIDcwIDEwMCIgZW5hYmxlLWJhY2tncm91bmQ9Im5ldyAwIDAgNzAgMTAwIiB4bWw6c3BhY2U9InByZXNlcnZlIj4NCjxwb2x5Z29uIGZpbGw9Ii\nNGRkZGRkYiIHN0cm9rZT0iIzZCNkI2QiIgc3Ryb2tlLW1pdGVybGltaXQ9IjEwIiBwb2ludHM9IjE3Ljc0Niw5OC41MjQgNDguODAxLDUwIDE3Ljc0NiwxLjQ3NiAx\nNC41NDUsMy41MjQgDQoJNDQuMjg5LDUwIDE0LjU0NSw5Ni40NzYgIi8+DQo8L3N2Zz4NCg==\">\n                <img *ngIf=\"ngBox.current.type == 1\"\n                     (load)=\"isLoaded()\" \n                     #ngBoxContent \n                     [src]=\"ngBox.current.url\"\n                     [hidden]=\"ngBox.loading\" \n                     (click)=\"nextNgBox()\"\n                     alt=\"\">\n                <iframe *ngIf=\"ngBox.current.type == 2\" \n                        #ngBoxContent\n                        [src]=\"ngBox.current.url\"\n                        width=\"{{ngBox.current.width}}\"\n                        height=\"{{ngBox.current.height}}\"\n                        frameborder=\"0\"\n                        allowfullscreen>\n                </iframe>\n                <iframe *ngIf=\"ngBox.current.type == 3\" \n                        [src]=\"ngBox.current.url\"\n                        #ngBoxContent\n                        width=\"{{ngBox.current.width}}\"\n                        height=\"{{ngBox.current.height}}\"\n                        frameborder=\"0\" \n                        webkitallowfullscreen \n                        mozallowfullscreen \n                        allowfullscreen>\n                </iframe>\n                <iframe *ngIf=\"ngBox.current.type == 4\" \n                        #ngBoxContent\n                        [src]=\"ngBox.current.url\"\n                        frameborder=\"0\"\n                        width=\"{{ngBox.current.width}}\"\n                        height=\"{{ngBox.current.height}}\"\n                        allowfullscreen>\n                </iframe>\n            </div>\n            <div #ngBoxButtons id=\"buttons\" [hidden]=\"ngBox.loading\">\n                <p>\n                    <span class=\"title\" *ngIf=\"ngBox.current.title\">{{ngBox.current.title}}<br/></span>\n                    <span class=\"pages\" *ngIf=\"getHasGroup()\">{{getCurrentIndex()}} of {{getCount()}}</span>\n                </p>\n                <img (click)=\"closeNgBox()\" id=\"closeButton\" src=\"data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZG\nluZz0idXRmLTgiPz4NCjwhLS0gR2VuZXJhdG9yOiBBZG9iZSBJbGx1c3RyYXRvciAxNS4xLjAsIFNWRyBFeHBvcnQgUGx1Zy1JbiAuIFNWRyBWZXJzaW9uOiA2LjAw\nIEJ1aWxkIDApICAtLT4NCjwhRE9DVFlQRSBzdmcgUFVCTElDICItLy9XM0MvL0RURCBTVkcgMS4xLy9FTiIgImh0dHA6Ly93d3cudzMub3JnL0dyYXBoaWNzL1NWRy\n8xLjEvRFREL3N2ZzExLmR0ZCI+DQo8c3ZnIHZlcnNpb249IjEuMSIgaWQ9IkxheWVyXzEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6\neGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHg9IjBweCIgeT0iMHB4Ig0KCSB3aWR0aD0iMzBweCIgaGVpZ2h0PSIzMHB4IiB2aWV3Qm94PSIwID\nAgMzAgMzAiIGVuYWJsZS1iYWNrZ3JvdW5kPSJuZXcgMCAwIDMwIDMwIiB4bWw6c3BhY2U9InByZXNlcnZlIj4NCjxwb2x5Z29uIGZpbGw9IiNGRkZGRkYiIHN0cm9r\nZT0iIzZCNkI2QiIgc3Ryb2tlLW1pdGVybGltaXQ9IjEwIiBwb2ludHM9IjI4LjUsMi44NCAyNS40NjMsMS41IDE1LDEyLjc0OSA0LjUzOSwxLjUgMS41LDIuODQgDQ\noJMTIuODExLDE1IDEuNSwyNy4xNiA0LjUzOSwyOC41IDE1LDE3LjI1MSAyNS40NjMsMjguNSAyOC41LDI3LjE2IDE3LjE4OSwxNSAiLz4NCjwvc3ZnPg0K\" alt=\"\">\n            </div>\n\n\n            \n            \n            \n\n        </div>\n    ",
            styles: ["\n        #ngBoxLoading{\n            text-align: center;\n            z-index: 10001;\n            width: 100%;\n            height: 100%;\n            color: white;\n            position: fixed;\n            top: 46%;\n            font-size: 20px;\n        }\n        #ngBoxWrapper {\n            background-color: rgba(0, 0, 0, 0.9);\n            position: fixed;\n            top: 0px;\n            left: 0px;\n            text-align: center;\n            z-index: 10000;\n            width: 100%;\n            height: 100%;\n        }\n\n        #ngBoxWrapper #ngBoxContent img {\n            -webkit-border-radius: 4px;\n            -moz-border-radius: 4px;\n            border-radius: 4px;\n        }\n\n        #ngBoxContent {\n            display: block;\n        }\n\n        button {\n            font-size: 12px;\n        }\n\n        iframe {\n            max-width: 100%;\n            max-height: 100%;\n        }\n        #buttons{\n            position: relative;\n            margin: 5px auto;\n            text-align: right;\n        }\n        #buttons p{\n            float: left;\n            color: white;\n            text-align: left;\n            margin: 0 50px 0 0;\n            font-size: 12px;\n            font-family: sans-serif;\n        }\n        #buttons span.title{\n            display: block;\n            height: 18px;\n            overflow: hidden;\n        }\n        #closeButton{\n            position: absolute;\n            top: 0px;\n            right: 0px;\n            cursor: pointer;\n        }\n        .left{\n            position: fixed;\n            left: -5px;\n            margin-top: -42px;\n            cursor: pointer;\n            top: 50%;\n        }\n        .right{\n            position: fixed;\n            right: -10px;\n            margin-top: -42px;\n            cursor: pointer;\n            top: 50%;\n        }\n    "]
        }),
        __metadata("design:paramtypes", [__WEBPACK_IMPORTED_MODULE_1__ngbox_service__["a" /* NgBoxService */]])
    ], NgBoxComponent);
    return NgBoxComponent;
}());



/***/ }),

/***/ "../../../../../src/app/ngbox/ngbox.directive.ts":
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "a", function() { return NgBoxDirective; });
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__angular_core__ = __webpack_require__("../../../core/esm5/core.js");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__angular_platform_browser__ = __webpack_require__("../../../platform-browser/esm5/platform-browser.js");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_2__ngbox_service__ = __webpack_require__("../../../../../src/app/ngbox/ngbox.service.ts");
var __decorate = (this && this.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};
var __metadata = (this && this.__metadata) || function (k, v) {
    if (typeof Reflect === "object" && typeof Reflect.metadata === "function") return Reflect.metadata(k, v);
};



var NgBoxDirective = (function () {
    function NgBoxDirective(ngBox, sanitizer) {
        this.ngBox = ngBox;
        this.sanitizer = sanitizer;
    }
    NgBoxDirective.prototype.ngOnDestroy = function () {
        this.removeImage();
    };
    NgBoxDirective.prototype.ngAfterViewInit = function () {
        this.ngBox.id = this.id = this.ngBox.id + 1;
        this.updateImage();
    };
    NgBoxDirective.prototype.removeImage = function () {
        var pos = this.ngBox.images.map(function (e) { return e.id; }).indexOf(this.id);
        if (pos !== -1)
            this.ngBox.images.splice(pos, 1);
    };
    NgBoxDirective.prototype.updateImage = function () {
        var src = this.src ? this.src : this.href;
        this.data = this.getData(src);
        this.ngBox.images.push(this.data);
    };
    NgBoxDirective.prototype.onClick = function ($event) {
        $event.preventDefault();
        this.removeImage();
        this.updateImage();
        this.ngBox.loading = true;
        this.ngBox.current = this.data;
        this.ngBox.open = true;
    };
    NgBoxDirective.prototype.getData = function (url) {
        if (url !== undefined || url !== '') {
            // Youtube
            var regExp = /^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|\&v=|\?v=)([^#\&\?]*).*/;
            var match = url.match(regExp);
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
    };
    __decorate([
        Object(__WEBPACK_IMPORTED_MODULE_0__angular_core__["Input"])(),
        __metadata("design:type", Object)
    ], NgBoxDirective.prototype, "src", void 0);
    __decorate([
        Object(__WEBPACK_IMPORTED_MODULE_0__angular_core__["Input"])(),
        __metadata("design:type", Object)
    ], NgBoxDirective.prototype, "href", void 0);
    __decorate([
        Object(__WEBPACK_IMPORTED_MODULE_0__angular_core__["Input"])(),
        __metadata("design:type", String)
    ], NgBoxDirective.prototype, "title", void 0);
    __decorate([
        Object(__WEBPACK_IMPORTED_MODULE_0__angular_core__["Input"])(),
        __metadata("design:type", String)
    ], NgBoxDirective.prototype, "width", void 0);
    __decorate([
        Object(__WEBPACK_IMPORTED_MODULE_0__angular_core__["Input"])(),
        __metadata("design:type", String)
    ], NgBoxDirective.prototype, "height", void 0);
    __decorate([
        Object(__WEBPACK_IMPORTED_MODULE_0__angular_core__["Input"])(),
        __metadata("design:type", String)
    ], NgBoxDirective.prototype, "group", void 0);
    __decorate([
        Object(__WEBPACK_IMPORTED_MODULE_0__angular_core__["Input"])(),
        __metadata("design:type", Boolean)
    ], NgBoxDirective.prototype, "cache", void 0);
    __decorate([
        Object(__WEBPACK_IMPORTED_MODULE_0__angular_core__["Input"])(),
        __metadata("design:type", Boolean)
    ], NgBoxDirective.prototype, "image", void 0);
    __decorate([
        Object(__WEBPACK_IMPORTED_MODULE_0__angular_core__["HostListener"])('click', ['$event']),
        __metadata("design:type", Function),
        __metadata("design:paramtypes", [Object]),
        __metadata("design:returntype", void 0)
    ], NgBoxDirective.prototype, "onClick", null);
    NgBoxDirective = __decorate([
        Object(__WEBPACK_IMPORTED_MODULE_0__angular_core__["Directive"])({
            selector: '[myNgBox],[ng-box]'
        }),
        __metadata("design:paramtypes", [__WEBPACK_IMPORTED_MODULE_2__ngbox_service__["a" /* NgBoxService */],
            __WEBPACK_IMPORTED_MODULE_1__angular_platform_browser__["DomSanitizer"]])
    ], NgBoxDirective);
    return NgBoxDirective;
}());



/***/ }),

/***/ "../../../../../src/app/ngbox/ngbox.service.ts":
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "a", function() { return NgBoxService; });
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__angular_core__ = __webpack_require__("../../../core/esm5/core.js");
var __decorate = (this && this.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};
var __metadata = (this && this.__metadata) || function (k, v) {
    if (typeof Reflect === "object" && typeof Reflect.metadata === "function") return Reflect.metadata(k, v);
};

var NgBoxService = (function () {
    function NgBoxService() {
        this.id = 0;
        this.loading = false;
        this.open = false;
        this.images = [];
    }
    NgBoxService = __decorate([
        Object(__WEBPACK_IMPORTED_MODULE_0__angular_core__["Injectable"])(),
        __metadata("design:paramtypes", [])
    ], NgBoxService);
    return NgBoxService;
}());



/***/ }),

/***/ "../../../../../src/app/pages/gallery-page/gallery-page.component.css":
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__("../../../../css-loader/lib/css-base.js")(false);
// imports


// module
exports.push([module.i, "", ""]);

// exports


/*** EXPORTS FROM exports-loader ***/
module.exports = module.exports.toString();

/***/ }),

/***/ "../../../../../src/app/pages/gallery-page/gallery-page.component.html":
/***/ (function(module, exports) {

module.exports = "<gallery-toolbar></gallery-toolbar>\n<gallery-info></gallery-info>\n<gallery-list></gallery-list>\n<image-list></image-list>"

/***/ }),

/***/ "../../../../../src/app/pages/gallery-page/gallery-page.component.ts":
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "a", function() { return GalleryPageComponent; });
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__angular_core__ = __webpack_require__("../../../core/esm5/core.js");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__angular_router__ = __webpack_require__("../../../router/esm5/router.js");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_2__services_page_data_service__ = __webpack_require__("../../../../../src/app/services/page_data.service.ts");
var __decorate = (this && this.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};
var __metadata = (this && this.__metadata) || function (k, v) {
    if (typeof Reflect === "object" && typeof Reflect.metadata === "function") return Reflect.metadata(k, v);
};



var GalleryPageComponent = (function () {
    function GalleryPageComponent(route, page_data_service) {
        this.route = route;
        this.page_data_service = page_data_service;
    }
    GalleryPageComponent.prototype.ngOnInit = function () {
        var _this = this;
        this.route.params.subscribe(function (params) {
            _this.page_data_service.GetGalleryPageData(params['id']);
        });
    };
    GalleryPageComponent = __decorate([
        Object(__WEBPACK_IMPORTED_MODULE_0__angular_core__["Component"])({
            selector: 'gallery-page',
            template: __webpack_require__("../../../../../src/app/pages/gallery-page/gallery-page.component.html"),
            styles: [__webpack_require__("../../../../../src/app/pages/gallery-page/gallery-page.component.css")]
        }),
        __metadata("design:paramtypes", [__WEBPACK_IMPORTED_MODULE_1__angular_router__["a" /* ActivatedRoute */],
            __WEBPACK_IMPORTED_MODULE_2__services_page_data_service__["a" /* PageDataService */]])
    ], GalleryPageComponent);
    return GalleryPageComponent;
}());



/***/ }),

/***/ "../../../../../src/app/pages/home-page/home-page.component.css":
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__("../../../../css-loader/lib/css-base.js")(false);
// imports


// module
exports.push([module.i, "", ""]);

// exports


/*** EXPORTS FROM exports-loader ***/
module.exports = module.exports.toString();

/***/ }),

/***/ "../../../../../src/app/pages/home-page/home-page.component.html":
/***/ (function(module, exports) {

module.exports = "<home-toolbar></home-toolbar>\n\n<gallery-list></gallery-list>"

/***/ }),

/***/ "../../../../../src/app/pages/home-page/home-page.component.ts":
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "a", function() { return HomePageComponent; });
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__angular_core__ = __webpack_require__("../../../core/esm5/core.js");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__services_page_data_service__ = __webpack_require__("../../../../../src/app/services/page_data.service.ts");
var __decorate = (this && this.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};
var __metadata = (this && this.__metadata) || function (k, v) {
    if (typeof Reflect === "object" && typeof Reflect.metadata === "function") return Reflect.metadata(k, v);
};


var HomePageComponent = (function () {
    function HomePageComponent(page_data_service) {
        this.page_data_service = page_data_service;
    }
    HomePageComponent.prototype.ngOnInit = function () {
        this.page_data_service.GetHomePageData();
    };
    HomePageComponent = __decorate([
        Object(__WEBPACK_IMPORTED_MODULE_0__angular_core__["Component"])({
            selector: 'moa',
            template: __webpack_require__("../../../../../src/app/pages/home-page/home-page.component.html"),
            styles: [__webpack_require__("../../../../../src/app/pages/home-page/home-page.component.css")]
        }),
        __metadata("design:paramtypes", [__WEBPACK_IMPORTED_MODULE_1__services_page_data_service__["a" /* PageDataService */]])
    ], HomePageComponent);
    return HomePageComponent;
}());



/***/ }),

/***/ "../../../../../src/app/pages/image-page/image-page.component.css":
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__("../../../../css-loader/lib/css-base.js")(false);
// imports


// module
exports.push([module.i, "", ""]);

// exports


/*** EXPORTS FROM exports-loader ***/
module.exports = module.exports.toString();

/***/ }),

/***/ "../../../../../src/app/pages/image-page/image-page.component.html":
/***/ (function(module, exports) {

module.exports = "<image-toolbar></image-toolbar>\n<image-info></image-info>"

/***/ }),

/***/ "../../../../../src/app/pages/image-page/image-page.component.ts":
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "a", function() { return ImagePageComponent; });
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__angular_core__ = __webpack_require__("../../../core/esm5/core.js");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__angular_router__ = __webpack_require__("../../../router/esm5/router.js");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_2__services_page_data_service__ = __webpack_require__("../../../../../src/app/services/page_data.service.ts");
var __decorate = (this && this.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};
var __metadata = (this && this.__metadata) || function (k, v) {
    if (typeof Reflect === "object" && typeof Reflect.metadata === "function") return Reflect.metadata(k, v);
};



var ImagePageComponent = (function () {
    function ImagePageComponent(route, page_data_service) {
        this.route = route;
        this.page_data_service = page_data_service;
    }
    ImagePageComponent.prototype.ngOnInit = function () {
        var _this = this;
        this.route.params.subscribe(function (params) {
            _this.page_data_service.GetImagePageData(params['image_id'], params['gallery_id']);
        });
    };
    ImagePageComponent = __decorate([
        Object(__WEBPACK_IMPORTED_MODULE_0__angular_core__["Component"])({
            selector: 'image-page',
            template: __webpack_require__("../../../../../src/app/pages/image-page/image-page.component.html"),
            styles: [__webpack_require__("../../../../../src/app/pages/image-page/image-page.component.css")]
        }),
        __metadata("design:paramtypes", [__WEBPACK_IMPORTED_MODULE_1__angular_router__["a" /* ActivatedRoute */],
            __WEBPACK_IMPORTED_MODULE_2__services_page_data_service__["a" /* PageDataService */]])
    ], ImagePageComponent);
    return ImagePageComponent;
}());



/***/ }),

/***/ "../../../../../src/app/services/button-click.service.ts":
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "a", function() { return ButtonClickService; });
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__angular_core__ = __webpack_require__("../../../core/esm5/core.js");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1_rxjs_Subject__ = __webpack_require__("../../../../rxjs/_esm5/Subject.js");
var __decorate = (this && this.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};
var __metadata = (this && this.__metadata) || function (k, v) {
    if (typeof Reflect === "object" && typeof Reflect.metadata === "function") return Reflect.metadata(k, v);
};


var ButtonClickService = (function () {
    function ButtonClickService() {
        this.notify = new __WEBPACK_IMPORTED_MODULE_1_rxjs_Subject__["Subject"]();
        this.notifyObservable$ = this.notify.asObservable();
    }
    ButtonClickService.prototype.trigger = function (name, data) {
        if (data === void 0) { data = null; }
        if (name) {
            this.notify.next({
                name: name,
                data: data
            });
        }
    };
    ButtonClickService = __decorate([
        Object(__WEBPACK_IMPORTED_MODULE_0__angular_core__["Injectable"])(),
        __metadata("design:paramtypes", [])
    ], ButtonClickService);
    return ButtonClickService;
}());



/***/ }),

/***/ "../../../../../src/app/services/data.service.ts":
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "a", function() { return DataService; });
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__angular_core__ = __webpack_require__("../../../core/esm5/core.js");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__angular_common_http__ = __webpack_require__("../../../common/esm5/http.js");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_2_rxjs_BehaviorSubject__ = __webpack_require__("../../../../rxjs/_esm5/BehaviorSubject.js");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_3_rxjs_add_operator_map__ = __webpack_require__("../../../../rxjs/_esm5/add/operator/map.js");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_4_rxjs_add_operator_filter__ = __webpack_require__("../../../../rxjs/_esm5/add/operator/filter.js");
var __decorate = (this && this.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};
var __metadata = (this && this.__metadata) || function (k, v) {
    if (typeof Reflect === "object" && typeof Reflect.metadata === "function") return Reflect.metadata(k, v);
};





var DataService = (function () {
    function DataService(http) {
        this.http = http;
        this.data = new __WEBPACK_IMPORTED_MODULE_2_rxjs_BehaviorSubject__["a" /* BehaviorSubject */]([]);
    }
    DataService.prototype.setPageData = function (pageData) {
        this.data.next(pageData);
    };
    DataService.prototype.getBreadcrumbObserver = function () {
        return this.data
            .map(function (data) {
            return data.breadcrumbs;
        })
            .filter(function (data) { return data !== undefined; });
    };
    DataService.prototype.getGalleriesObserver = function () {
        return this.data
            .map(function (data) {
            return data.galleries;
        })
            .filter(function (data) { return data !== undefined; });
    };
    DataService.prototype.getGalleryObserver = function () {
        return this.data
            .map(function (data) {
            // TODO: Convert to Gallery model?
            return data.gallery;
        })
            .filter(function (data) { return data !== undefined; });
    };
    DataService.prototype.getImageObserver = function () {
        return this.data
            .map(function (data) {
            // TODO: Convert to Image model?
            return data.image;
        })
            .filter(function (data) { return data !== undefined; });
    };
    DataService.prototype.getImagesObserver = function () {
        return this.data
            .map(function (data) {
            return data.images;
        })
            .filter(function (data) { return data !== undefined; });
    };
    DataService.prototype.getPageTitleObserver = function () {
        return this.data
            .map(function (data) {
            return data.page_title;
        })
            .filter(function (data) { return data !== undefined; });
    };
    DataService = __decorate([
        Object(__WEBPACK_IMPORTED_MODULE_0__angular_core__["Injectable"])(),
        __metadata("design:paramtypes", [__WEBPACK_IMPORTED_MODULE_1__angular_common_http__["a" /* HttpClient */]])
    ], DataService);
    return DataService;
}());



/***/ }),

/***/ "../../../../../src/app/services/gallery_service.ts":
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "a", function() { return GalleryService; });
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__angular_core__ = __webpack_require__("../../../core/esm5/core.js");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__data_service__ = __webpack_require__("../../../../../src/app/services/data.service.ts");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_2__angular_common_http__ = __webpack_require__("../../../common/esm5/http.js");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_3_rxjs_Subject__ = __webpack_require__("../../../../rxjs/_esm5/Subject.js");
var __decorate = (this && this.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};
var __metadata = (this && this.__metadata) || function (k, v) {
    if (typeof Reflect === "object" && typeof Reflect.metadata === "function") return Reflect.metadata(k, v);
};




var GalleryService = (function () {
    function GalleryService(dataService, http) {
        this.dataService = dataService;
        this.http = http;
        this.api_url = '/api/gallery/';
    }
    GalleryService.prototype.SubmitGallery = function (data) {
        var _this = this;
        var url = this.api_url + data.id;
        var subject = new __WEBPACK_IMPORTED_MODULE_3_rxjs_Subject__["Subject"]();
        var body = {
            name: data.name,
            description: data.description,
            parent: data.parent,
            tags: data.tags,
            useTags: data.useTags,
            showImages: data.showImages
        };
        if (data.id > 0) {
            this.http.put(url, body).subscribe(function (data) {
                subject.next({ success: data['success'], message: data['message'] });
                _this.dataService.setPageData(data);
            });
        }
        else {
            this.http.post(url, body).subscribe(function (data) {
                subject.next({ success: data['success'], message: data['message'] });
                _this.dataService.setPageData(data);
            });
        }
        return subject.asObservable();
    };
    GalleryService.prototype.DeleteGallery = function (id, parent_id) {
        var url = this.api_url + id;
        var subject = new __WEBPACK_IMPORTED_MODULE_3_rxjs_Subject__["Subject"]();
        this.http.delete(url)
            .subscribe(function (data) {
            subject.next({ success: data['success'], message: data['message'] });
        });
        return subject.asObservable();
    };
    GalleryService = __decorate([
        Object(__WEBPACK_IMPORTED_MODULE_0__angular_core__["Injectable"])(),
        __metadata("design:paramtypes", [__WEBPACK_IMPORTED_MODULE_1__data_service__["a" /* DataService */],
            __WEBPACK_IMPORTED_MODULE_2__angular_common_http__["a" /* HttpClient */]])
    ], GalleryService);
    return GalleryService;
}());



/***/ }),

/***/ "../../../../../src/app/services/image_service.ts":
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "a", function() { return ImageService; });
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__angular_core__ = __webpack_require__("../../../core/esm5/core.js");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__data_service__ = __webpack_require__("../../../../../src/app/services/data.service.ts");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_2__angular_common_http__ = __webpack_require__("../../../common/esm5/http.js");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_3_rxjs_Subject__ = __webpack_require__("../../../../rxjs/_esm5/Subject.js");
var __decorate = (this && this.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};
var __metadata = (this && this.__metadata) || function (k, v) {
    if (typeof Reflect === "object" && typeof Reflect.metadata === "function") return Reflect.metadata(k, v);
};




var ImageService = (function () {
    function ImageService(dataService, http) {
        this.dataService = dataService;
        this.http = http;
        this.api_url = '/api/image/';
    }
    ImageService.prototype.SubmitImages = function (data) {
        var _this = this;
        var url = this.api_url + data.id;
        var subject = new __WEBPACK_IMPORTED_MODULE_3_rxjs_Subject__["Subject"]();
        var body = {
            id: data.id,
            gallery_id: data.gallery_id,
            description: data.description,
            tags: data.tags,
            fileHashes: data.fileHashes
        };
        if (data.id > 0) {
            this.http.put(url, body).subscribe(function (data) {
                subject.next({ success: data['success'], message: data['message'] });
                _this.dataService.setPageData(data);
            });
        }
        else {
            this.http.post(url, body).subscribe(function (data) {
                subject.next({ success: data['success'], message: data['message'] });
                _this.dataService.setPageData(data);
            });
        }
        return subject.asObservable();
    };
    ImageService.prototype.DeleteImage = function (id) {
        var url = this.api_url + id;
        var subject = new __WEBPACK_IMPORTED_MODULE_3_rxjs_Subject__["Subject"]();
        this.http.delete(url)
            .subscribe(function (data) {
            subject.next({ success: data['success'], message: data['message'] });
        });
        return subject.asObservable();
    };
    ImageService = __decorate([
        Object(__WEBPACK_IMPORTED_MODULE_0__angular_core__["Injectable"])(),
        __metadata("design:paramtypes", [__WEBPACK_IMPORTED_MODULE_1__data_service__["a" /* DataService */],
            __WEBPACK_IMPORTED_MODULE_2__angular_common_http__["a" /* HttpClient */]])
    ], ImageService);
    return ImageService;
}());



/***/ }),

/***/ "../../../../../src/app/services/page_data.service.ts":
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "a", function() { return PageDataService; });
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__angular_core__ = __webpack_require__("../../../core/esm5/core.js");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__data_service__ = __webpack_require__("../../../../../src/app/services/data.service.ts");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_2__angular_common_http__ = __webpack_require__("../../../common/esm5/http.js");
var __decorate = (this && this.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};
var __metadata = (this && this.__metadata) || function (k, v) {
    if (typeof Reflect === "object" && typeof Reflect.metadata === "function") return Reflect.metadata(k, v);
};



var PageDataService = (function () {
    function PageDataService(data_service, http) {
        this.data_service = data_service;
        this.http = http;
        this.api_url = '/api/page_data/';
    }
    PageDataService.prototype.GetPageData = function (url) {
        var _this = this;
        this.http.get(url).subscribe(function (data) {
            _this.data_service.setPageData(data);
        });
    };
    PageDataService.prototype.GetHomePageData = function () {
        var url = this.api_url + 'home_page';
        this.GetPageData(url);
    };
    PageDataService.prototype.GetGalleryPageData = function (id) {
        var url = this.api_url + 'gallery_page/' + id;
        this.GetPageData(url);
    };
    PageDataService.prototype.GetImagePageData = function (image_id, gallery_id) {
        var url = this.api_url + 'image_page/' + gallery_id + '/' + image_id;
        this.GetPageData(url);
    };
    PageDataService = __decorate([
        Object(__WEBPACK_IMPORTED_MODULE_0__angular_core__["Injectable"])(),
        __metadata("design:paramtypes", [__WEBPACK_IMPORTED_MODULE_1__data_service__["a" /* DataService */], __WEBPACK_IMPORTED_MODULE_2__angular_common_http__["a" /* HttpClient */]])
    ], PageDataService);
    return PageDataService;
}());



/***/ }),

/***/ "../../../../../src/app/services/page_title.service.ts":
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "a", function() { return PageTitleService; });
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__angular_core__ = __webpack_require__("../../../core/esm5/core.js");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__data_service__ = __webpack_require__("../../../../../src/app/services/data.service.ts");
var __decorate = (this && this.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};
var __metadata = (this && this.__metadata) || function (k, v) {
    if (typeof Reflect === "object" && typeof Reflect.metadata === "function") return Reflect.metadata(k, v);
};


var PageTitleService = (function () {
    function PageTitleService(service) {
        this.service = service;
        this.observer = service.getPageTitleObserver().subscribe(function (data) {
            document.title = data;
        });
    }
    PageTitleService.prototype.ngOnDestroy = function () {
        this.observer.unsubscribe();
    };
    PageTitleService = __decorate([
        Object(__WEBPACK_IMPORTED_MODULE_0__angular_core__["Injectable"])(),
        __metadata("design:paramtypes", [__WEBPACK_IMPORTED_MODULE_1__data_service__["a" /* DataService */]])
    ], PageTitleService);
    return PageTitleService;
}());



/***/ }),

/***/ "../../../../../src/app/services/thumbnail.service.ts":
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "a", function() { return ThumbnailService; });
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__angular_core__ = __webpack_require__("../../../core/esm5/core.js");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1_rxjs_Subject__ = __webpack_require__("../../../../rxjs/_esm5/Subject.js");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_2__angular_common_http__ = __webpack_require__("../../../common/esm5/http.js");
var __decorate = (this && this.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};
var __metadata = (this && this.__metadata) || function (k, v) {
    if (typeof Reflect === "object" && typeof Reflect.metadata === "function") return Reflect.metadata(k, v);
};



var ThumbnailService = (function () {
    function ThumbnailService(http) {
        this.http = http;
        this.api_url = '/api/thumbnail_status';
    }
    ThumbnailService.prototype.getStatus = function (data) {
        if (data === void 0) { data = null; }
        var subject = new __WEBPACK_IMPORTED_MODULE_1_rxjs_Subject__["Subject"]();
        var params = data.join(',');
        var url = this.api_url + '?images=' + params;
        this.http.get(url).subscribe(function (data) {
            subject.next(data);
        });
        return subject.asObservable();
    };
    ThumbnailService = __decorate([
        Object(__WEBPACK_IMPORTED_MODULE_0__angular_core__["Injectable"])(),
        __metadata("design:paramtypes", [__WEBPACK_IMPORTED_MODULE_2__angular_common_http__["a" /* HttpClient */]])
    ], ThumbnailService);
    return ThumbnailService;
}());



/***/ }),

/***/ "../../../../../src/environments/environment.ts":
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "a", function() { return environment; });
// The file contents for the current environment will overwrite these during build.
// The build system defaults to the dev environment which uses `environment.ts`, but if you do
// `ng build --env=prod` then `environment.prod.ts` will be used instead.
// The list of which env maps to which file can be found in `.angular-cli.json`.
var environment = {
    production: false
};


/***/ }),

/***/ "../../../../../src/main.ts":
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__angular_core__ = __webpack_require__("../../../core/esm5/core.js");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__angular_platform_browser_dynamic__ = __webpack_require__("../../../platform-browser-dynamic/esm5/platform-browser-dynamic.js");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_2__app_app_module__ = __webpack_require__("../../../../../src/app/app.module.ts");
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_3__environments_environment__ = __webpack_require__("../../../../../src/environments/environment.ts");




if (__WEBPACK_IMPORTED_MODULE_3__environments_environment__["a" /* environment */].production) {
    Object(__WEBPACK_IMPORTED_MODULE_0__angular_core__["enableProdMode"])();
}
Object(__WEBPACK_IMPORTED_MODULE_1__angular_platform_browser_dynamic__["a" /* platformBrowserDynamic */])().bootstrapModule(__WEBPACK_IMPORTED_MODULE_2__app_app_module__["a" /* AppModule */])
    .catch(function (err) { return console.log(err); });


/***/ }),

/***/ 0:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__("../../../../../src/main.ts");


/***/ })

},[0]);
//# sourceMappingURL=main.bundle.js.map