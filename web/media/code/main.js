(window["webpackJsonp"] = window["webpackJsonp"] || []).push([["main"],{

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

/***/ "./src/app/app.component.ts":
/*!**********************************!*\
  !*** ./src/app/app.component.ts ***!
  \**********************************/
/*! exports provided: AppComponent */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "AppComponent", function() { return AppComponent; });
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @angular/core */ "./node_modules/@angular/core/__ivy_ngcc__/fesm2015/core.js");
/* harmony import */ var _services_data_service__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./services/data.service */ "./src/app/services/data.service.ts");
/* harmony import */ var _angular_router__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @angular/router */ "./node_modules/@angular/router/__ivy_ngcc__/fesm2015/router.js");
/* harmony import */ var _services_page_title_service__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./services/page_title.service */ "./src/app/services/page_title.service.ts");
/* harmony import */ var _services_identity_service__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ./services/identity.service */ "./src/app/services/identity.service.ts");
/* harmony import */ var _breadcrumb_breadcrumb_component__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! ./breadcrumb/breadcrumb.component */ "./src/app/breadcrumb/breadcrumb.component.ts");











class AppComponent {
    constructor(router, service, pageTitleService, identityService, elementRef) {
        this.router = router;
        this.service = service;
        this.pageTitleService = pageTitleService;
        this.identityService = identityService;
        this.elementRef = elementRef;
        this.preload = {
            rights: {
                isAdmin: false
            }
        };
        this.data = [];
        this.preload = JSON.parse(this.elementRef.nativeElement.getAttribute('[preload]'));
    }
    ngOnInit() {
        this.service.setPageData(this.preload);
        this.identityService.SetRights({
            isAdmin: this.preload.rights.isAdmin
        });
    }
}
AppComponent.ɵfac = function AppComponent_Factory(t) { return new (t || AppComponent)(_angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵdirectiveInject"](_angular_router__WEBPACK_IMPORTED_MODULE_2__["Router"]), _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵdirectiveInject"](_services_data_service__WEBPACK_IMPORTED_MODULE_1__["DataService"]), _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵdirectiveInject"](_services_page_title_service__WEBPACK_IMPORTED_MODULE_3__["PageTitleService"]), _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵdirectiveInject"](_services_identity_service__WEBPACK_IMPORTED_MODULE_4__["IdentityService"]), _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵdirectiveInject"](_angular_core__WEBPACK_IMPORTED_MODULE_0__["ElementRef"])); };
AppComponent.ɵcmp = _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵdefineComponent"]({ type: AppComponent, selectors: [["app-root"]], decls: 2, vars: 0, template: function AppComponent_Template(rf, ctx) { if (rf & 1) {
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelement"](0, "breadcrumb");
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelement"](1, "router-outlet");
    } }, directives: [_breadcrumb_breadcrumb_component__WEBPACK_IMPORTED_MODULE_5__["BreadcrumbComponent"], _angular_router__WEBPACK_IMPORTED_MODULE_2__["RouterOutlet"]], styles: ["\n/*# sourceMappingURL=data:application/json;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbXSwibmFtZXMiOltdLCJtYXBwaW5ncyI6IiIsImZpbGUiOiJzcmMvYXBwL2FwcC5jb21wb25lbnQuY3NzIn0= */"] });
/*@__PURE__*/ (function () { _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵsetClassMetadata"](AppComponent, [{
        type: _angular_core__WEBPACK_IMPORTED_MODULE_0__["Component"],
        args: [{
                selector: 'app-root',
                templateUrl: './app.component.html',
                styleUrls: ['./app.component.css']
            }]
    }], function () { return [{ type: _angular_router__WEBPACK_IMPORTED_MODULE_2__["Router"] }, { type: _services_data_service__WEBPACK_IMPORTED_MODULE_1__["DataService"] }, { type: _services_page_title_service__WEBPACK_IMPORTED_MODULE_3__["PageTitleService"] }, { type: _services_identity_service__WEBPACK_IMPORTED_MODULE_4__["IdentityService"] }, { type: _angular_core__WEBPACK_IMPORTED_MODULE_0__["ElementRef"] }]; }, null); })();


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
/* harmony import */ var _angular_platform_browser__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @angular/platform-browser */ "./node_modules/@angular/platform-browser/__ivy_ngcc__/fesm2015/platform-browser.js");
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @angular/core */ "./node_modules/@angular/core/__ivy_ngcc__/fesm2015/core.js");
/* harmony import */ var _app_component__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./app.component */ "./src/app/app.component.ts");
/* harmony import */ var _breadcrumb_breadcrumb_component__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./breadcrumb/breadcrumb.component */ "./src/app/breadcrumb/breadcrumb.component.ts");
/* harmony import */ var _gallery_gallery_list_gallery_list_component__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ./gallery/gallery-list/gallery-list.component */ "./src/app/gallery/gallery-list/gallery-list.component.ts");
/* harmony import */ var _gallery_gallery_tile_gallery_tile_component__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! ./gallery/gallery-tile/gallery-tile.component */ "./src/app/gallery/gallery-tile/gallery-tile.component.ts");
/* harmony import */ var _services_data_service__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! ./services/data.service */ "./src/app/services/data.service.ts");
/* harmony import */ var _services_page_title_service__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(/*! ./services/page_title.service */ "./src/app/services/page_title.service.ts");
/* harmony import */ var _services_page_data_service__WEBPACK_IMPORTED_MODULE_8__ = __webpack_require__(/*! ./services/page_data.service */ "./src/app/services/page_data.service.ts");
/* harmony import */ var _angular_common_http__WEBPACK_IMPORTED_MODULE_9__ = __webpack_require__(/*! @angular/common/http */ "./node_modules/@angular/common/__ivy_ngcc__/fesm2015/http.js");
/* harmony import */ var _angular_router__WEBPACK_IMPORTED_MODULE_10__ = __webpack_require__(/*! @angular/router */ "./node_modules/@angular/router/__ivy_ngcc__/fesm2015/router.js");
/* harmony import */ var _pages_gallery_page_gallery_page_component__WEBPACK_IMPORTED_MODULE_11__ = __webpack_require__(/*! ./pages/gallery-page/gallery-page.component */ "./src/app/pages/gallery-page/gallery-page.component.ts");
/* harmony import */ var _pages_home_page_home_page_component__WEBPACK_IMPORTED_MODULE_12__ = __webpack_require__(/*! ./pages/home-page/home-page.component */ "./src/app/pages/home-page/home-page.component.ts");
/* harmony import */ var _gallery_gallery_info_gallery_info_component__WEBPACK_IMPORTED_MODULE_13__ = __webpack_require__(/*! ./gallery/gallery-info/gallery-info.component */ "./src/app/gallery/gallery-info/gallery-info.component.ts");
/* harmony import */ var _image_image_list_image_list_component__WEBPACK_IMPORTED_MODULE_14__ = __webpack_require__(/*! ./image/image-list/image-list.component */ "./src/app/image/image-list/image-list.component.ts");
/* harmony import */ var _image_image_thumb_image_thumb_component__WEBPACK_IMPORTED_MODULE_15__ = __webpack_require__(/*! ./image/image-thumb/image-thumb.component */ "./src/app/image/image-thumb/image-thumb.component.ts");
/* harmony import */ var _gallery_gallery_toolbar_gallery_toolbar_component__WEBPACK_IMPORTED_MODULE_16__ = __webpack_require__(/*! ./gallery/gallery-toolbar/gallery-toolbar.component */ "./src/app/gallery/gallery-toolbar/gallery-toolbar.component.ts");
/* harmony import */ var _gallery_gallery_edit_gallery_edit_component__WEBPACK_IMPORTED_MODULE_17__ = __webpack_require__(/*! ./gallery/gallery-edit/gallery-edit.component */ "./src/app/gallery/gallery-edit/gallery-edit.component.ts");
/* harmony import */ var _services_button_click_service__WEBPACK_IMPORTED_MODULE_18__ = __webpack_require__(/*! ./services/button-click.service */ "./src/app/services/button-click.service.ts");
/* harmony import */ var _angular_forms__WEBPACK_IMPORTED_MODULE_19__ = __webpack_require__(/*! @angular/forms */ "./node_modules/@angular/forms/__ivy_ngcc__/fesm2015/forms.js");
/* harmony import */ var _services_identity_service__WEBPACK_IMPORTED_MODULE_20__ = __webpack_require__(/*! ./services/identity.service */ "./src/app/services/identity.service.ts");
/* harmony import */ var _services_gallery_service__WEBPACK_IMPORTED_MODULE_21__ = __webpack_require__(/*! ./services/gallery_service */ "./src/app/services/gallery_service.ts");
/* harmony import */ var _services_image_service__WEBPACK_IMPORTED_MODULE_22__ = __webpack_require__(/*! ./services/image_service */ "./src/app/services/image_service.ts");
/* harmony import */ var _pages_image_page_image_page_component__WEBPACK_IMPORTED_MODULE_23__ = __webpack_require__(/*! ./pages/image-page/image-page.component */ "./src/app/pages/image-page/image-page.component.ts");
/* harmony import */ var _image_image_info_image_info_component__WEBPACK_IMPORTED_MODULE_24__ = __webpack_require__(/*! ./image/image-info/image-info.component */ "./src/app/image/image-info/image-info.component.ts");
/* harmony import */ var _image_image_toolbar_image_toolbar_component__WEBPACK_IMPORTED_MODULE_25__ = __webpack_require__(/*! ./image/image-toolbar/image-toolbar.component */ "./src/app/image/image-toolbar/image-toolbar.component.ts");
/* harmony import */ var _image_image_edit_image_edit_component__WEBPACK_IMPORTED_MODULE_26__ = __webpack_require__(/*! ./image/image-edit/image-edit.component */ "./src/app/image/image-edit/image-edit.component.ts");
/* harmony import */ var _services_thumbnail_service__WEBPACK_IMPORTED_MODULE_27__ = __webpack_require__(/*! ./services/thumbnail.service */ "./src/app/services/thumbnail.service.ts");
/* harmony import */ var _image_image_add_image_add_component__WEBPACK_IMPORTED_MODULE_28__ = __webpack_require__(/*! ./image/image-add/image-add.component */ "./src/app/image/image-add/image-add.component.ts");
/* harmony import */ var primeng_fileupload__WEBPACK_IMPORTED_MODULE_29__ = __webpack_require__(/*! primeng/fileupload */ "./node_modules/primeng/__ivy_ngcc__/fesm2015/primeng-fileupload.js");
/* harmony import */ var _home_home_toolbar_home_toolbar_component__WEBPACK_IMPORTED_MODULE_30__ = __webpack_require__(/*! ./home/home-toolbar/home-toolbar.component */ "./src/app/home/home-toolbar/home-toolbar.component.ts");
/* harmony import */ var _ngbox_ngbox_service__WEBPACK_IMPORTED_MODULE_31__ = __webpack_require__(/*! ./ngbox/ngbox.service */ "./src/app/ngbox/ngbox.service.ts");
/* harmony import */ var _ngbox_ngbox_component__WEBPACK_IMPORTED_MODULE_32__ = __webpack_require__(/*! ./ngbox/ngbox.component */ "./src/app/ngbox/ngbox.component.ts");
/* harmony import */ var _ngbox_ngbox_directive__WEBPACK_IMPORTED_MODULE_33__ = __webpack_require__(/*! ./ngbox/ngbox.directive */ "./src/app/ngbox/ngbox.directive.ts");
/* harmony import */ var _angular_platform_browser_animations__WEBPACK_IMPORTED_MODULE_34__ = __webpack_require__(/*! @angular/platform-browser/animations */ "./node_modules/@angular/platform-browser/__ivy_ngcc__/fesm2015/animations.js");





































const routes = [
    { path: '', component: _pages_home_page_home_page_component__WEBPACK_IMPORTED_MODULE_12__["HomePageComponent"] },
    { path: 'gallery/:id', component: _pages_gallery_page_gallery_page_component__WEBPACK_IMPORTED_MODULE_11__["GalleryPageComponent"] },
    { path: 'image/:gallery_id/:image_id', component: _pages_image_page_image_page_component__WEBPACK_IMPORTED_MODULE_23__["ImagePageComponent"] }
];
class AppModule {
}
AppModule.ɵmod = _angular_core__WEBPACK_IMPORTED_MODULE_1__["ɵɵdefineNgModule"]({ type: AppModule, bootstrap: [_app_component__WEBPACK_IMPORTED_MODULE_2__["AppComponent"]] });
AppModule.ɵinj = _angular_core__WEBPACK_IMPORTED_MODULE_1__["ɵɵdefineInjector"]({ factory: function AppModule_Factory(t) { return new (t || AppModule)(); }, providers: [
        _services_data_service__WEBPACK_IMPORTED_MODULE_6__["DataService"],
        _services_page_title_service__WEBPACK_IMPORTED_MODULE_7__["PageTitleService"],
        _services_page_data_service__WEBPACK_IMPORTED_MODULE_8__["PageDataService"],
        _services_button_click_service__WEBPACK_IMPORTED_MODULE_18__["ButtonClickService"],
        _services_gallery_service__WEBPACK_IMPORTED_MODULE_21__["GalleryService"],
        _services_image_service__WEBPACK_IMPORTED_MODULE_22__["ImageService"],
        _services_thumbnail_service__WEBPACK_IMPORTED_MODULE_27__["ThumbnailService"],
        _ngbox_ngbox_service__WEBPACK_IMPORTED_MODULE_31__["NgBoxService"],
        _services_identity_service__WEBPACK_IMPORTED_MODULE_20__["IdentityService"]
    ], imports: [[
            _angular_platform_browser__WEBPACK_IMPORTED_MODULE_0__["BrowserModule"],
            _angular_common_http__WEBPACK_IMPORTED_MODULE_9__["HttpClientModule"],
            _angular_router__WEBPACK_IMPORTED_MODULE_10__["RouterModule"].forRoot(routes),
            _angular_forms__WEBPACK_IMPORTED_MODULE_19__["FormsModule"],
            primeng_fileupload__WEBPACK_IMPORTED_MODULE_29__["FileUploadModule"],
            _angular_platform_browser_animations__WEBPACK_IMPORTED_MODULE_34__["BrowserAnimationsModule"]
        ]] });
(function () { (typeof ngJitMode === "undefined" || ngJitMode) && _angular_core__WEBPACK_IMPORTED_MODULE_1__["ɵɵsetNgModuleScope"](AppModule, { declarations: [_app_component__WEBPACK_IMPORTED_MODULE_2__["AppComponent"],
        _breadcrumb_breadcrumb_component__WEBPACK_IMPORTED_MODULE_3__["BreadcrumbComponent"],
        _gallery_gallery_list_gallery_list_component__WEBPACK_IMPORTED_MODULE_4__["GalleryListComponent"],
        _gallery_gallery_tile_gallery_tile_component__WEBPACK_IMPORTED_MODULE_5__["GalleryTileComponent"],
        _gallery_gallery_info_gallery_info_component__WEBPACK_IMPORTED_MODULE_13__["GalleryInfoComponent"],
        _gallery_gallery_toolbar_gallery_toolbar_component__WEBPACK_IMPORTED_MODULE_16__["GalleryToolbarComponent"],
        _gallery_gallery_edit_gallery_edit_component__WEBPACK_IMPORTED_MODULE_17__["GalleryEditComponent"],
        _image_image_list_image_list_component__WEBPACK_IMPORTED_MODULE_14__["ImageListComponent"],
        _image_image_thumb_image_thumb_component__WEBPACK_IMPORTED_MODULE_15__["ImageThumbComponent"],
        _image_image_info_image_info_component__WEBPACK_IMPORTED_MODULE_24__["ImageInfoComponent"],
        _home_home_toolbar_home_toolbar_component__WEBPACK_IMPORTED_MODULE_30__["HomeToolbarComponent"],
        // Route pages
        _pages_home_page_home_page_component__WEBPACK_IMPORTED_MODULE_12__["HomePageComponent"],
        _pages_gallery_page_gallery_page_component__WEBPACK_IMPORTED_MODULE_11__["GalleryPageComponent"],
        _pages_image_page_image_page_component__WEBPACK_IMPORTED_MODULE_23__["ImagePageComponent"],
        _image_image_toolbar_image_toolbar_component__WEBPACK_IMPORTED_MODULE_25__["ImageToolbarComponent"],
        _image_image_edit_image_edit_component__WEBPACK_IMPORTED_MODULE_26__["ImageEditComponent"],
        _image_image_add_image_add_component__WEBPACK_IMPORTED_MODULE_28__["ImageAddComponent"],
        _ngbox_ngbox_component__WEBPACK_IMPORTED_MODULE_32__["NgBoxComponent"],
        _ngbox_ngbox_directive__WEBPACK_IMPORTED_MODULE_33__["NgBoxDirective"]], imports: [_angular_platform_browser__WEBPACK_IMPORTED_MODULE_0__["BrowserModule"],
        _angular_common_http__WEBPACK_IMPORTED_MODULE_9__["HttpClientModule"], _angular_router__WEBPACK_IMPORTED_MODULE_10__["RouterModule"], _angular_forms__WEBPACK_IMPORTED_MODULE_19__["FormsModule"],
        primeng_fileupload__WEBPACK_IMPORTED_MODULE_29__["FileUploadModule"],
        _angular_platform_browser_animations__WEBPACK_IMPORTED_MODULE_34__["BrowserAnimationsModule"]] }); })();
/*@__PURE__*/ (function () { _angular_core__WEBPACK_IMPORTED_MODULE_1__["ɵsetClassMetadata"](AppModule, [{
        type: _angular_core__WEBPACK_IMPORTED_MODULE_1__["NgModule"],
        args: [{
                declarations: [
                    _app_component__WEBPACK_IMPORTED_MODULE_2__["AppComponent"],
                    _breadcrumb_breadcrumb_component__WEBPACK_IMPORTED_MODULE_3__["BreadcrumbComponent"],
                    _gallery_gallery_list_gallery_list_component__WEBPACK_IMPORTED_MODULE_4__["GalleryListComponent"],
                    _gallery_gallery_tile_gallery_tile_component__WEBPACK_IMPORTED_MODULE_5__["GalleryTileComponent"],
                    _gallery_gallery_info_gallery_info_component__WEBPACK_IMPORTED_MODULE_13__["GalleryInfoComponent"],
                    _gallery_gallery_toolbar_gallery_toolbar_component__WEBPACK_IMPORTED_MODULE_16__["GalleryToolbarComponent"],
                    _gallery_gallery_edit_gallery_edit_component__WEBPACK_IMPORTED_MODULE_17__["GalleryEditComponent"],
                    _image_image_list_image_list_component__WEBPACK_IMPORTED_MODULE_14__["ImageListComponent"],
                    _image_image_thumb_image_thumb_component__WEBPACK_IMPORTED_MODULE_15__["ImageThumbComponent"],
                    _image_image_info_image_info_component__WEBPACK_IMPORTED_MODULE_24__["ImageInfoComponent"],
                    _home_home_toolbar_home_toolbar_component__WEBPACK_IMPORTED_MODULE_30__["HomeToolbarComponent"],
                    // Route pages
                    _pages_home_page_home_page_component__WEBPACK_IMPORTED_MODULE_12__["HomePageComponent"],
                    _pages_gallery_page_gallery_page_component__WEBPACK_IMPORTED_MODULE_11__["GalleryPageComponent"],
                    _pages_image_page_image_page_component__WEBPACK_IMPORTED_MODULE_23__["ImagePageComponent"],
                    _image_image_toolbar_image_toolbar_component__WEBPACK_IMPORTED_MODULE_25__["ImageToolbarComponent"],
                    _image_image_edit_image_edit_component__WEBPACK_IMPORTED_MODULE_26__["ImageEditComponent"],
                    _image_image_add_image_add_component__WEBPACK_IMPORTED_MODULE_28__["ImageAddComponent"],
                    _ngbox_ngbox_component__WEBPACK_IMPORTED_MODULE_32__["NgBoxComponent"],
                    _ngbox_ngbox_directive__WEBPACK_IMPORTED_MODULE_33__["NgBoxDirective"]
                ],
                imports: [
                    _angular_platform_browser__WEBPACK_IMPORTED_MODULE_0__["BrowserModule"],
                    _angular_common_http__WEBPACK_IMPORTED_MODULE_9__["HttpClientModule"],
                    _angular_router__WEBPACK_IMPORTED_MODULE_10__["RouterModule"].forRoot(routes),
                    _angular_forms__WEBPACK_IMPORTED_MODULE_19__["FormsModule"],
                    primeng_fileupload__WEBPACK_IMPORTED_MODULE_29__["FileUploadModule"],
                    _angular_platform_browser_animations__WEBPACK_IMPORTED_MODULE_34__["BrowserAnimationsModule"]
                ],
                providers: [
                    _services_data_service__WEBPACK_IMPORTED_MODULE_6__["DataService"],
                    _services_page_title_service__WEBPACK_IMPORTED_MODULE_7__["PageTitleService"],
                    _services_page_data_service__WEBPACK_IMPORTED_MODULE_8__["PageDataService"],
                    _services_button_click_service__WEBPACK_IMPORTED_MODULE_18__["ButtonClickService"],
                    _services_gallery_service__WEBPACK_IMPORTED_MODULE_21__["GalleryService"],
                    _services_image_service__WEBPACK_IMPORTED_MODULE_22__["ImageService"],
                    _services_thumbnail_service__WEBPACK_IMPORTED_MODULE_27__["ThumbnailService"],
                    _ngbox_ngbox_service__WEBPACK_IMPORTED_MODULE_31__["NgBoxService"],
                    _services_identity_service__WEBPACK_IMPORTED_MODULE_20__["IdentityService"]
                ],
                bootstrap: [
                    _app_component__WEBPACK_IMPORTED_MODULE_2__["AppComponent"]
                ]
            }]
    }], null, null); })();


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
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @angular/core */ "./node_modules/@angular/core/__ivy_ngcc__/fesm2015/core.js");
/* harmony import */ var _services_data_service__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../services/data.service */ "./src/app/services/data.service.ts");
/* harmony import */ var _angular_router__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @angular/router */ "./node_modules/@angular/router/__ivy_ngcc__/fesm2015/router.js");
/* harmony import */ var _angular_common__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @angular/common */ "./node_modules/@angular/common/__ivy_ngcc__/fesm2015/common.js");






const _c0 = function (a0) { return [a0]; };
function BreadcrumbComponent_li_4_a_1_Template(rf, ctx) { if (rf & 1) {
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementStart"](0, "a", 1);
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵtext"](1);
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementEnd"]();
} if (rf & 2) {
    const crumb_r1 = _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵnextContext"]().$implicit;
    const ctx_r3 = _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵnextContext"]();
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵproperty"]("routerLink", _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵpureFunction1"](2, _c0, ctx_r3.getLink(crumb_r1.id)));
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵadvance"](1);
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵtextInterpolate"](crumb_r1.name);
} }
function BreadcrumbComponent_li_4_span_2_Template(rf, ctx) { if (rf & 1) {
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementStart"](0, "span");
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵtext"](1);
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementEnd"]();
} if (rf & 2) {
    const crumb_r1 = _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵnextContext"]().$implicit;
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵadvance"](1);
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵtextInterpolate"](crumb_r1.name);
} }
function BreadcrumbComponent_li_4_Template(rf, ctx) { if (rf & 1) {
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementStart"](0, "li");
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵtemplate"](1, BreadcrumbComponent_li_4_a_1_Template, 2, 4, "a", 3);
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵtemplate"](2, BreadcrumbComponent_li_4_span_2_Template, 2, 1, "span", 4);
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementEnd"]();
} if (rf & 2) {
    const last_r2 = ctx.last;
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵadvance"](1);
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵproperty"]("ngIf", !last_r2);
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵadvance"](1);
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵproperty"]("ngIf", last_r2);
} }
const _c1 = function () { return ["/"]; };
class BreadcrumbComponent {
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
}
BreadcrumbComponent.ɵfac = function BreadcrumbComponent_Factory(t) { return new (t || BreadcrumbComponent)(_angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵdirectiveInject"](_services_data_service__WEBPACK_IMPORTED_MODULE_1__["DataService"])); };
BreadcrumbComponent.ɵcmp = _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵdefineComponent"]({ type: BreadcrumbComponent, selectors: [["breadcrumb"]], decls: 5, vars: 3, consts: [[1, "breadcrumb"], [3, "routerLink"], [4, "ngFor", "ngForOf"], [3, "routerLink", 4, "ngIf"], [4, "ngIf"]], template: function BreadcrumbComponent_Template(rf, ctx) { if (rf & 1) {
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementStart"](0, "ol", 0);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementStart"](1, "li");
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementStart"](2, "a", 1);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵtext"](3, "Home");
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementEnd"]();
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementEnd"]();
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵtemplate"](4, BreadcrumbComponent_li_4_Template, 3, 2, "li", 2);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementEnd"]();
    } if (rf & 2) {
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵadvance"](2);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵproperty"]("routerLink", _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵpureFunction0"](2, _c1));
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵadvance"](2);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵproperty"]("ngForOf", ctx.crumbs);
    } }, directives: [_angular_router__WEBPACK_IMPORTED_MODULE_2__["RouterLinkWithHref"], _angular_common__WEBPACK_IMPORTED_MODULE_3__["NgForOf"], _angular_common__WEBPACK_IMPORTED_MODULE_3__["NgIf"]], styles: ["\n/*# sourceMappingURL=data:application/json;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbXSwibmFtZXMiOltdLCJtYXBwaW5ncyI6IiIsImZpbGUiOiJzcmMvYXBwL2JyZWFkY3J1bWIvYnJlYWRjcnVtYi5jb21wb25lbnQuY3NzIn0= */"] });
/*@__PURE__*/ (function () { _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵsetClassMetadata"](BreadcrumbComponent, [{
        type: _angular_core__WEBPACK_IMPORTED_MODULE_0__["Component"],
        args: [{
                selector: 'breadcrumb',
                templateUrl: './breadcrumb.component.html',
                styleUrls: ['./breadcrumb.component.css']
            }]
    }], function () { return [{ type: _services_data_service__WEBPACK_IMPORTED_MODULE_1__["DataService"] }]; }, null); })();


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
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @angular/core */ "./node_modules/@angular/core/__ivy_ngcc__/fesm2015/core.js");
/* harmony import */ var _services_button_click_service__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../../services/button-click.service */ "./src/app/services/button-click.service.ts");
/* harmony import */ var _services_gallery_service__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../services/gallery_service */ "./src/app/services/gallery_service.ts");
/* harmony import */ var _angular_router__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @angular/router */ "./node_modules/@angular/router/__ivy_ngcc__/fesm2015/router.js");
/* harmony import */ var _angular_forms__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! @angular/forms */ "./node_modules/@angular/forms/__ivy_ngcc__/fesm2015/forms.js");
/* harmony import */ var _angular_common__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! @angular/common */ "./node_modules/@angular/common/__ivy_ngcc__/fesm2015/common.js");










function GalleryEditComponent_option_33_Template(rf, ctx) { if (rf & 1) {
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementStart"](0, "option", 17);
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵtext"](1);
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementEnd"]();
} if (rf & 2) {
    const tag_r1 = ctx.$implicit;
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵpropertyInterpolate"]("value", tag_r1.id);
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵadvance"](1);
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵtextInterpolate"](tag_r1.name);
} }
class GalleryEditComponent {
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
}
GalleryEditComponent.ɵfac = function GalleryEditComponent_Factory(t) { return new (t || GalleryEditComponent)(_angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵdirectiveInject"](_services_button_click_service__WEBPACK_IMPORTED_MODULE_1__["ButtonClickService"]), _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵdirectiveInject"](_services_gallery_service__WEBPACK_IMPORTED_MODULE_2__["GalleryService"]), _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵdirectiveInject"](_angular_router__WEBPACK_IMPORTED_MODULE_3__["Router"])); };
GalleryEditComponent.ɵcmp = _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵdefineComponent"]({ type: GalleryEditComponent, selectors: [["gallery-edit"]], inputs: { gallery: "gallery" }, decls: 52, vars: 8, consts: [["id", "edit-modal", 1, "modal", "fade"], [1, "modal-dialog"], [1, "modal-content"], [1, "modal-header"], ["type", "button", "data-dismiss", "modal", "aria-label", "Close", 1, "close"], ["aria-hidden", "true"], [1, "modal-title"], ["method", "post", 1, "form-horizontal", 3, "action"], [1, "modal-body"], [1, "form-group"], ["for", "inputGalleryName", 1, "col-sm-2", "control-label"], [1, "col-sm-10"], ["type", "text", "name", "inputGalleryName", "id", "inputGalleryName", "placeholder", "Edit...", 1, "form-control", 3, "ngModel", "ngModelChange"], ["for", "inputGalleryDescription", 1, "col-sm-2", "control-label"], ["name", "inputGalleryDescription", "id", "inputGalleryDescription", "placeholder", "Edit...", 1, "form-control", 3, "ngModel", "ngModelChange"], ["for", "inputGalleryParent", 1, "col-sm-2", "control-label"], ["name", "inputGalleryParent", "id", "inputGalleryParent", 1, "form-control", 2, "width", "100%"], ["selected", "selected", 3, "value"], ["for", "inputGalleryTags", 1, "col-sm-2", "control-label"], ["name", "inputGalleryTags[]", "id", "inputGalleryTags", "multiple", "", 1, "form-control", 2, "width", "100%"], ["selected", "selected", 3, "value", 4, "ngFor", "ngForOf"], [1, "checkbox"], [1, "col-sm-2"], ["type", "checkbox", "name", "inputGalleryCombinedView", "id", "inputGalleryCombinedView", 3, "ngModel", "ngModelChange"], ["for", "inputGalleryCombinedView", 1, "control-label"], ["type", "checkbox", "name", "inputGalleryUseTags", "id", "inputGalleryUseTags", 3, "ngModel", "ngModelChange"], ["for", "inputGalleryUseTags", 1, "control-label"], [1, "modal-footer"], ["type", "button", "data-dismiss", "modal", 1, "btn", "btn-default"], ["type", "submit", "value", "Save changes", 1, "btn", "btn-primary", 3, "click"]], template: function GalleryEditComponent_Template(rf, ctx) { if (rf & 1) {
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementStart"](0, "div", 0);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementStart"](1, "div", 1);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementStart"](2, "div", 2);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementStart"](3, "div", 3);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementStart"](4, "button", 4);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementStart"](5, "span", 5);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵtext"](6, "\u00D7");
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementEnd"]();
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementEnd"]();
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementStart"](7, "h4", 6);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵtext"](8, "Edit gallery");
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementEnd"]();
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementEnd"]();
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementStart"](9, "form", 7);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementStart"](10, "div", 8);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementStart"](11, "div", 9);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementStart"](12, "label", 10);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵtext"](13, "Name");
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementEnd"]();
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementStart"](14, "div", 11);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementStart"](15, "input", 12);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵlistener"]("ngModelChange", function GalleryEditComponent_Template_input_ngModelChange_15_listener($event) { return ctx.name = $event; });
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementEnd"]();
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementEnd"]();
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementEnd"]();
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementStart"](16, "div", 9);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementStart"](17, "label", 13);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵtext"](18, "Description");
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementEnd"]();
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementStart"](19, "div", 11);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementStart"](20, "textarea", 14);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵlistener"]("ngModelChange", function GalleryEditComponent_Template_textarea_ngModelChange_20_listener($event) { return ctx.description = $event; });
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementEnd"]();
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementEnd"]();
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementEnd"]();
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementStart"](21, "div", 9);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementStart"](22, "label", 15);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵtext"](23, "Parent");
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementEnd"]();
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementStart"](24, "div", 11);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementStart"](25, "select", 16);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementStart"](26, "option", 17);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵtext"](27);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementEnd"]();
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementEnd"]();
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementEnd"]();
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementEnd"]();
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementStart"](28, "div", 9);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementStart"](29, "label", 18);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵtext"](30, "Tags");
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementEnd"]();
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementStart"](31, "div", 11);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementStart"](32, "select", 19);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵtemplate"](33, GalleryEditComponent_option_33_Template, 2, 2, "option", 20);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementEnd"]();
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementEnd"]();
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementEnd"]();
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementStart"](34, "div", 9);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementStart"](35, "div", 21);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelement"](36, "div", 22);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementStart"](37, "div", 11);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementStart"](38, "input", 23);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵlistener"]("ngModelChange", function GalleryEditComponent_Template_input_ngModelChange_38_listener($event) { return ctx.showImages = $event; });
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementEnd"]();
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementStart"](39, "label", 24);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵtext"](40, "Show images when there are subgalleries");
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementEnd"]();
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementEnd"]();
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementEnd"]();
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementEnd"]();
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementStart"](41, "div", 9);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementStart"](42, "div", 21);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelement"](43, "div", 22);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementStart"](44, "div", 11);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementStart"](45, "input", 25);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵlistener"]("ngModelChange", function GalleryEditComponent_Template_input_ngModelChange_45_listener($event) { return ctx.useTags = $event; });
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementEnd"]();
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementStart"](46, "label", 26);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵtext"](47, "Populate from tags");
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementEnd"]();
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementEnd"]();
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementEnd"]();
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementEnd"]();
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementEnd"]();
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementStart"](48, "div", 27);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementStart"](49, "button", 28);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵtext"](50, "Close");
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementEnd"]();
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementStart"](51, "input", 29);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵlistener"]("click", function GalleryEditComponent_Template_input_click_51_listener() { return ctx.onSubmit(); });
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementEnd"]();
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementEnd"]();
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementEnd"]();
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementEnd"]();
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementEnd"]();
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementEnd"]();
    } if (rf & 2) {
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵadvance"](9);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵpropertyInterpolate1"]("action", "/gallery/", ctx.gallery.id, "", _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵsanitizeUrl"]);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵadvance"](6);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵproperty"]("ngModel", ctx.name);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵadvance"](5);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵproperty"]("ngModel", ctx.description);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵadvance"](6);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵpropertyInterpolate"]("value", ctx.parent_gallery.id);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵadvance"](1);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵtextInterpolate"](ctx.parent_gallery.name);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵadvance"](6);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵproperty"]("ngForOf", ctx.tagList);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵadvance"](5);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵproperty"]("ngModel", ctx.showImages);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵadvance"](7);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵproperty"]("ngModel", ctx.useTags);
    } }, directives: [_angular_forms__WEBPACK_IMPORTED_MODULE_4__["ɵangular_packages_forms_forms_y"], _angular_forms__WEBPACK_IMPORTED_MODULE_4__["NgControlStatusGroup"], _angular_forms__WEBPACK_IMPORTED_MODULE_4__["NgForm"], _angular_forms__WEBPACK_IMPORTED_MODULE_4__["DefaultValueAccessor"], _angular_forms__WEBPACK_IMPORTED_MODULE_4__["NgControlStatus"], _angular_forms__WEBPACK_IMPORTED_MODULE_4__["NgModel"], _angular_forms__WEBPACK_IMPORTED_MODULE_4__["NgSelectOption"], _angular_forms__WEBPACK_IMPORTED_MODULE_4__["ɵangular_packages_forms_forms_x"], _angular_common__WEBPACK_IMPORTED_MODULE_5__["NgForOf"], _angular_forms__WEBPACK_IMPORTED_MODULE_4__["CheckboxControlValueAccessor"]], styles: ["\n/*# sourceMappingURL=data:application/json;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbXSwibmFtZXMiOltdLCJtYXBwaW5ncyI6IiIsImZpbGUiOiJzcmMvYXBwL2dhbGxlcnkvZ2FsbGVyeS1lZGl0L2dhbGxlcnktZWRpdC5jb21wb25lbnQuY3NzIn0= */"] });
/*@__PURE__*/ (function () { _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵsetClassMetadata"](GalleryEditComponent, [{
        type: _angular_core__WEBPACK_IMPORTED_MODULE_0__["Component"],
        args: [{
                selector: 'gallery-edit',
                templateUrl: './gallery-edit.component.html',
                styleUrls: ['./gallery-edit.component.css']
            }]
    }], function () { return [{ type: _services_button_click_service__WEBPACK_IMPORTED_MODULE_1__["ButtonClickService"] }, { type: _services_gallery_service__WEBPACK_IMPORTED_MODULE_2__["GalleryService"] }, { type: _angular_router__WEBPACK_IMPORTED_MODULE_3__["Router"] }]; }, { gallery: [{
            type: _angular_core__WEBPACK_IMPORTED_MODULE_0__["Input"]
        }] }); })();


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
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @angular/core */ "./node_modules/@angular/core/__ivy_ngcc__/fesm2015/core.js");
/* harmony import */ var _services_data_service__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../../services/data.service */ "./src/app/services/data.service.ts");




class GalleryInfoComponent {
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
}
GalleryInfoComponent.ɵfac = function GalleryInfoComponent_Factory(t) { return new (t || GalleryInfoComponent)(_angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵdirectiveInject"](_services_data_service__WEBPACK_IMPORTED_MODULE_1__["DataService"])); };
GalleryInfoComponent.ɵcmp = _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵdefineComponent"]({ type: GalleryInfoComponent, selectors: [["gallery-info"]], decls: 4, vars: 2, template: function GalleryInfoComponent_Template(rf, ctx) { if (rf & 1) {
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementStart"](0, "h1");
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵtext"](1);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementEnd"]();
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementStart"](2, "p");
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵtext"](3);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementEnd"]();
    } if (rf & 2) {
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵadvance"](1);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵtextInterpolate"](ctx.gallery.name);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵadvance"](2);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵtextInterpolate1"](" ", ctx.gallery.description, "\n");
    } }, styles: ["\n/*# sourceMappingURL=data:application/json;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbXSwibmFtZXMiOltdLCJtYXBwaW5ncyI6IiIsImZpbGUiOiJzcmMvYXBwL2dhbGxlcnkvZ2FsbGVyeS1pbmZvL2dhbGxlcnktaW5mby5jb21wb25lbnQuY3NzIn0= */"] });
/*@__PURE__*/ (function () { _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵsetClassMetadata"](GalleryInfoComponent, [{
        type: _angular_core__WEBPACK_IMPORTED_MODULE_0__["Component"],
        args: [{
                selector: 'gallery-info',
                templateUrl: './gallery-info.component.html',
                styleUrls: ['./gallery-info.component.css']
            }]
    }], function () { return [{ type: _services_data_service__WEBPACK_IMPORTED_MODULE_1__["DataService"] }]; }, null); })();


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
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @angular/core */ "./node_modules/@angular/core/__ivy_ngcc__/fesm2015/core.js");
/* harmony import */ var _services_data_service__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../../services/data.service */ "./src/app/services/data.service.ts");
/* harmony import */ var _angular_common__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @angular/common */ "./node_modules/@angular/common/__ivy_ngcc__/fesm2015/common.js");
/* harmony import */ var _gallery_tile_gallery_tile_component__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../gallery-tile/gallery-tile.component */ "./src/app/gallery/gallery-tile/gallery-tile.component.ts");






function GalleryListComponent_li_2_Template(rf, ctx) { if (rf & 1) {
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementStart"](0, "li", 3);
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelement"](1, "gallery-tile", 4);
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementEnd"]();
} if (rf & 2) {
    const gallery_r1 = ctx.$implicit;
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵadvance"](1);
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵproperty"]("gallery", gallery_r1);
} }
class GalleryListComponent {
    constructor(service) {
        this.service = service;
        this.observer = service.getGalleriesObserver().subscribe(data => {
            this.galleries = data;
        });
    }
    ngOnDestroy() {
        this.observer.unsubscribe();
    }
}
GalleryListComponent.ɵfac = function GalleryListComponent_Factory(t) { return new (t || GalleryListComponent)(_angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵdirectiveInject"](_services_data_service__WEBPACK_IMPORTED_MODULE_1__["DataService"])); };
GalleryListComponent.ɵcmp = _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵdefineComponent"]({ type: GalleryListComponent, selectors: [["gallery-list"]], decls: 3, vars: 1, consts: [[1, "row"], [1, "list-unstyled"], ["class", "thumbnail col-md-3", "style", "min-height: 150px;", 4, "ngFor", "ngForOf"], [1, "thumbnail", "col-md-3", 2, "min-height", "150px"], [3, "gallery"]], template: function GalleryListComponent_Template(rf, ctx) { if (rf & 1) {
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementStart"](0, "div", 0);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementStart"](1, "ul", 1);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵtemplate"](2, GalleryListComponent_li_2_Template, 2, 1, "li", 2);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementEnd"]();
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementEnd"]();
    } if (rf & 2) {
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵadvance"](2);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵproperty"]("ngForOf", ctx.galleries);
    } }, directives: [_angular_common__WEBPACK_IMPORTED_MODULE_2__["NgForOf"], _gallery_tile_gallery_tile_component__WEBPACK_IMPORTED_MODULE_3__["GalleryTileComponent"]], styles: [".thumbnail[_ngcontent-%COMP%] {\n    height: 250px;\n}\n/*# sourceMappingURL=data:application/json;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbInNyYy9hcHAvZ2FsbGVyeS9nYWxsZXJ5LWxpc3QvZ2FsbGVyeS1saXN0LmNvbXBvbmVudC5jc3MiXSwibmFtZXMiOltdLCJtYXBwaW5ncyI6IkFBQUE7SUFDSSxhQUFhO0FBQ2pCIiwiZmlsZSI6InNyYy9hcHAvZ2FsbGVyeS9nYWxsZXJ5LWxpc3QvZ2FsbGVyeS1saXN0LmNvbXBvbmVudC5jc3MiLCJzb3VyY2VzQ29udGVudCI6WyIudGh1bWJuYWlsIHtcbiAgICBoZWlnaHQ6IDI1MHB4O1xufSJdfQ== */"] });
/*@__PURE__*/ (function () { _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵsetClassMetadata"](GalleryListComponent, [{
        type: _angular_core__WEBPACK_IMPORTED_MODULE_0__["Component"],
        args: [{
                selector: 'gallery-list',
                templateUrl: './gallery-list.component.html',
                styleUrls: ['./gallery-list.component.css']
            }]
    }], function () { return [{ type: _services_data_service__WEBPACK_IMPORTED_MODULE_1__["DataService"] }]; }, null); })();


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
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @angular/core */ "./node_modules/@angular/core/__ivy_ngcc__/fesm2015/core.js");
/* harmony import */ var _models_gallery_model__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../../models/gallery.model */ "./src/app/models/gallery.model.ts");
/* harmony import */ var _angular_router__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @angular/router */ "./node_modules/@angular/router/__ivy_ngcc__/fesm2015/router.js");
/* harmony import */ var _angular_common__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @angular/common */ "./node_modules/@angular/common/__ivy_ngcc__/fesm2015/common.js");





function GalleryTileComponent_img_1_Template(rf, ctx) { if (rf & 1) {
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelement"](0, "img", 3);
} }
function GalleryTileComponent_img_2_Template(rf, ctx) { if (rf & 1) {
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelement"](0, "img", 4);
} if (rf & 2) {
    const ctx_r1 = _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵnextContext"]();
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵpropertyInterpolate1"]("src", "/image/thumb/", ctx_r1.gallery.thumb_id, ".jpg", _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵsanitizeUrl"]);
} }
const _c0 = function (a0) { return [a0]; };
class GalleryTileComponent {
    constructor() { }
    getLink(id) {
        return '/gallery/' + this.gallery.id;
    }
    doesThumbExist(thumb_id) {
        return thumb_id !== null;
    }
}
GalleryTileComponent.ɵfac = function GalleryTileComponent_Factory(t) { return new (t || GalleryTileComponent)(); };
GalleryTileComponent.ɵcmp = _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵdefineComponent"]({ type: GalleryTileComponent, selectors: [["gallery-tile"]], inputs: { gallery: "gallery" }, decls: 5, vars: 6, consts: [[3, "routerLink"], ["src", "http://placehold.it/300x200", 4, "ngIf"], [3, "src", 4, "ngIf"], ["src", "http://placehold.it/300x200"], [3, "src"]], template: function GalleryTileComponent_Template(rf, ctx) { if (rf & 1) {
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementStart"](0, "a", 0);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵtemplate"](1, GalleryTileComponent_img_1_Template, 1, 0, "img", 1);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵtemplate"](2, GalleryTileComponent_img_2_Template, 1, 1, "img", 2);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementStart"](3, "h4");
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵtext"](4);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementEnd"]();
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementEnd"]();
    } if (rf & 2) {
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵproperty"]("routerLink", _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵpureFunction1"](4, _c0, ctx.getLink(ctx.gallery.id)));
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵadvance"](1);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵproperty"]("ngIf", !ctx.doesThumbExist(ctx.gallery.thumb_id));
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵadvance"](1);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵproperty"]("ngIf", ctx.doesThumbExist(ctx.gallery.thumb_id));
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵadvance"](2);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵtextInterpolate"](ctx.gallery.name);
    } }, directives: [_angular_router__WEBPACK_IMPORTED_MODULE_2__["RouterLinkWithHref"], _angular_common__WEBPACK_IMPORTED_MODULE_3__["NgIf"]], styles: ["\n/*# sourceMappingURL=data:application/json;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbXSwibmFtZXMiOltdLCJtYXBwaW5ncyI6IiIsImZpbGUiOiJzcmMvYXBwL2dhbGxlcnkvZ2FsbGVyeS10aWxlL2dhbGxlcnktdGlsZS5jb21wb25lbnQuY3NzIn0= */"] });
/*@__PURE__*/ (function () { _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵsetClassMetadata"](GalleryTileComponent, [{
        type: _angular_core__WEBPACK_IMPORTED_MODULE_0__["Component"],
        args: [{
                selector: 'gallery-tile',
                templateUrl: './gallery-tile.component.html',
                styleUrls: ['./gallery-tile.component.css']
            }]
    }], function () { return []; }, { gallery: [{
            type: _angular_core__WEBPACK_IMPORTED_MODULE_0__["Input"]
        }] }); })();


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
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @angular/core */ "./node_modules/@angular/core/__ivy_ngcc__/fesm2015/core.js");
/* harmony import */ var _services_data_service__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../../services/data.service */ "./src/app/services/data.service.ts");
/* harmony import */ var _services_button_click_service__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../services/button-click.service */ "./src/app/services/button-click.service.ts");
/* harmony import */ var _services_gallery_service__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../../services/gallery_service */ "./src/app/services/gallery_service.ts");
/* harmony import */ var _angular_router__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! @angular/router */ "./node_modules/@angular/router/__ivy_ngcc__/fesm2015/router.js");
/* harmony import */ var _services_identity_service__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! ../../services/identity.service */ "./src/app/services/identity.service.ts");
/* harmony import */ var _gallery_edit_gallery_edit_component__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! ../gallery-edit/gallery-edit.component */ "./src/app/gallery/gallery-edit/gallery-edit.component.ts");
/* harmony import */ var _image_image_add_image_add_component__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(/*! ../../image/image-add/image-add.component */ "./src/app/image/image-add/image-add.component.ts");
/* harmony import */ var _angular_common__WEBPACK_IMPORTED_MODULE_8__ = __webpack_require__(/*! @angular/common */ "./node_modules/@angular/common/__ivy_ngcc__/fesm2015/common.js");















function GalleryToolbarComponent_div_4_Template(rf, ctx) { if (rf & 1) {
    const _r2 = _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵgetCurrentView"]();
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementStart"](0, "div", 4);
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementStart"](1, "button", 5);
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵlistener"]("click", function GalleryToolbarComponent_div_4_Template_button_click_1_listener() { _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵrestoreView"](_r2); const ctx_r1 = _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵnextContext"](); return ctx_r1.onAddGalleryClick(); });
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelement"](2, "span", 6);
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementEnd"]();
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementStart"](3, "button", 7);
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵlistener"]("click", function GalleryToolbarComponent_div_4_Template_button_click_3_listener() { _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵrestoreView"](_r2); const ctx_r3 = _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵnextContext"](); return ctx_r3.onAddImageClick(); });
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelement"](4, "span", 8);
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementEnd"]();
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementStart"](5, "button", 9);
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵlistener"]("click", function GalleryToolbarComponent_div_4_Template_button_click_5_listener() { _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵrestoreView"](_r2); const ctx_r4 = _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵnextContext"](); return ctx_r4.onEditClick(); });
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelement"](6, "span", 10);
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementEnd"]();
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementStart"](7, "button", 11);
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵlistener"]("click", function GalleryToolbarComponent_div_4_Template_button_click_7_listener() { _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵrestoreView"](_r2); const ctx_r5 = _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵnextContext"](); return ctx_r5.onDeleteClick(); });
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelement"](8, "span", 12);
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementEnd"]();
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementEnd"]();
} }
class GalleryToolbarComponent {
    constructor(dataService, buttonClickService, galleryService, identityService, router) {
        this.dataService = dataService;
        this.buttonClickService = buttonClickService;
        this.galleryService = galleryService;
        this.identityService = identityService;
        this.router = router;
        this.gallery = {
            id: 0,
            parent_id: 0,
            name: '',
            description: ''
        };
        this.rights = {
            isAdmin: false
        };
        this.observer = dataService.getGalleryObserver().subscribe(data => {
            this.gallery = data;
        });
        this.rights.isAdmin = identityService.isAdmin();
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
}
GalleryToolbarComponent.ɵfac = function GalleryToolbarComponent_Factory(t) { return new (t || GalleryToolbarComponent)(_angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵdirectiveInject"](_services_data_service__WEBPACK_IMPORTED_MODULE_1__["DataService"]), _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵdirectiveInject"](_services_button_click_service__WEBPACK_IMPORTED_MODULE_2__["ButtonClickService"]), _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵdirectiveInject"](_services_gallery_service__WEBPACK_IMPORTED_MODULE_3__["GalleryService"]), _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵdirectiveInject"](_services_identity_service__WEBPACK_IMPORTED_MODULE_5__["IdentityService"]), _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵdirectiveInject"](_angular_router__WEBPACK_IMPORTED_MODULE_4__["Router"])); };
GalleryToolbarComponent.ɵcmp = _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵdefineComponent"]({ type: GalleryToolbarComponent, selectors: [["gallery-toolbar"]], decls: 5, vars: 3, consts: [[3, "gallery"], [1, "row"], [1, "pull-right"], ["class", "btn-group", "role", "group", "aria-label", "...", 4, "ngIf"], ["role", "group", "aria-label", "...", 1, "btn-group"], ["type", "button", "id", "galleryAdd", "title", "Add gallery", "data-toggle", "tooltip", 1, "btn", "btn-default", 3, "click"], [1, "glyphicon", "glyphicon-th"], ["type", "button", "id", "imageAdd", "title", "Add image", "data-toggle", "tooltip", 1, "btn", "btn-default", 3, "click"], [1, "glyphicon", "glyphicon-picture"], ["type", "button", "id", "galleryEdit", "title", "Edit gallery", "data-toggle", "tooltip", 1, "btn", "btn-default", 3, "click"], [1, "glyphicon", "glyphicon-pencil"], ["type", "button", "id", "galleryDelete", "title", "Delete gallery", "data-toggle", "tooltip", 1, "btn", "btn-default", 3, "click"], [1, "glyphicon", "glyphicon-trash"]], template: function GalleryToolbarComponent_Template(rf, ctx) { if (rf & 1) {
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelement"](0, "gallery-edit", 0);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelement"](1, "image-add", 0);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementStart"](2, "div", 1);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementStart"](3, "div", 2);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵtemplate"](4, GalleryToolbarComponent_div_4_Template, 9, 0, "div", 3);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementEnd"]();
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementEnd"]();
    } if (rf & 2) {
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵproperty"]("gallery", ctx.gallery);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵadvance"](1);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵproperty"]("gallery", ctx.gallery);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵadvance"](3);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵproperty"]("ngIf", ctx.rights.isAdmin);
    } }, directives: [_gallery_edit_gallery_edit_component__WEBPACK_IMPORTED_MODULE_6__["GalleryEditComponent"], _image_image_add_image_add_component__WEBPACK_IMPORTED_MODULE_7__["ImageAddComponent"], _angular_common__WEBPACK_IMPORTED_MODULE_8__["NgIf"]], styles: ["\n/*# sourceMappingURL=data:application/json;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbXSwibmFtZXMiOltdLCJtYXBwaW5ncyI6IiIsImZpbGUiOiJzcmMvYXBwL2dhbGxlcnkvZ2FsbGVyeS10b29sYmFyL2dhbGxlcnktdG9vbGJhci5jb21wb25lbnQuY3NzIn0= */"] });
/*@__PURE__*/ (function () { _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵsetClassMetadata"](GalleryToolbarComponent, [{
        type: _angular_core__WEBPACK_IMPORTED_MODULE_0__["Component"],
        args: [{
                selector: 'gallery-toolbar',
                templateUrl: './gallery-toolbar.component.html',
                styleUrls: ['./gallery-toolbar.component.css']
            }]
    }], function () { return [{ type: _services_data_service__WEBPACK_IMPORTED_MODULE_1__["DataService"] }, { type: _services_button_click_service__WEBPACK_IMPORTED_MODULE_2__["ButtonClickService"] }, { type: _services_gallery_service__WEBPACK_IMPORTED_MODULE_3__["GalleryService"] }, { type: _services_identity_service__WEBPACK_IMPORTED_MODULE_5__["IdentityService"] }, { type: _angular_router__WEBPACK_IMPORTED_MODULE_4__["Router"] }]; }, null); })();


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
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @angular/core */ "./node_modules/@angular/core/__ivy_ngcc__/fesm2015/core.js");
/* harmony import */ var _services_data_service__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../../services/data.service */ "./src/app/services/data.service.ts");
/* harmony import */ var _services_button_click_service__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../services/button-click.service */ "./src/app/services/button-click.service.ts");
/* harmony import */ var _services_gallery_service__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../../services/gallery_service */ "./src/app/services/gallery_service.ts");
/* harmony import */ var _angular_router__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! @angular/router */ "./node_modules/@angular/router/__ivy_ngcc__/fesm2015/router.js");
/* harmony import */ var _services_identity_service__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! ../../services/identity.service */ "./src/app/services/identity.service.ts");
/* harmony import */ var _gallery_gallery_edit_gallery_edit_component__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! ../../gallery/gallery-edit/gallery-edit.component */ "./src/app/gallery/gallery-edit/gallery-edit.component.ts");
/* harmony import */ var _angular_common__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(/*! @angular/common */ "./node_modules/@angular/common/__ivy_ngcc__/fesm2015/common.js");














function HomeToolbarComponent_div_3_Template(rf, ctx) { if (rf & 1) {
    const _r2 = _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵgetCurrentView"]();
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementStart"](0, "div", 4);
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementStart"](1, "button", 5);
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵlistener"]("click", function HomeToolbarComponent_div_3_Template_button_click_1_listener() { _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵrestoreView"](_r2); const ctx_r1 = _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵnextContext"](); return ctx_r1.onAddGalleryClick(); });
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelement"](2, "span", 6);
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementEnd"]();
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementEnd"]();
} }
class HomeToolbarComponent {
    constructor(dataService, buttonClickService, galleryService, identityService, router) {
        this.dataService = dataService;
        this.buttonClickService = buttonClickService;
        this.galleryService = galleryService;
        this.identityService = identityService;
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
        this.rights = {
            isAdmin: false
        };
        this.observer = dataService.getGalleryObserver().subscribe(data => {
            this.gallery = data;
        });
        this.rights.isAdmin = identityService.isAdmin();
    }
    onAddGalleryClick() {
        this.buttonClickService.trigger('galleryAddClick');
    }
    ngOnDestroy() {
        this.observer.unsubscribe();
    }
}
HomeToolbarComponent.ɵfac = function HomeToolbarComponent_Factory(t) { return new (t || HomeToolbarComponent)(_angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵdirectiveInject"](_services_data_service__WEBPACK_IMPORTED_MODULE_1__["DataService"]), _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵdirectiveInject"](_services_button_click_service__WEBPACK_IMPORTED_MODULE_2__["ButtonClickService"]), _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵdirectiveInject"](_services_gallery_service__WEBPACK_IMPORTED_MODULE_3__["GalleryService"]), _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵdirectiveInject"](_services_identity_service__WEBPACK_IMPORTED_MODULE_5__["IdentityService"]), _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵdirectiveInject"](_angular_router__WEBPACK_IMPORTED_MODULE_4__["Router"])); };
HomeToolbarComponent.ɵcmp = _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵdefineComponent"]({ type: HomeToolbarComponent, selectors: [["home-toolbar"]], decls: 4, vars: 2, consts: [[3, "gallery"], [1, "row"], [1, "pull-right"], ["class", "btn-group", "role", "group", "aria-label", "...", 4, "ngIf"], ["role", "group", "aria-label", "...", 1, "btn-group"], ["type", "button", "id", "galleryAdd", "title", "Add gallery", "data-toggle", "tooltip", 1, "btn", "btn-default", 3, "click"], [1, "glyphicon", "glyphicon-th"]], template: function HomeToolbarComponent_Template(rf, ctx) { if (rf & 1) {
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelement"](0, "gallery-edit", 0);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementStart"](1, "div", 1);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementStart"](2, "div", 2);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵtemplate"](3, HomeToolbarComponent_div_3_Template, 3, 0, "div", 3);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementEnd"]();
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementEnd"]();
    } if (rf & 2) {
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵproperty"]("gallery", ctx.gallery);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵadvance"](3);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵproperty"]("ngIf", ctx.rights.isAdmin);
    } }, directives: [_gallery_gallery_edit_gallery_edit_component__WEBPACK_IMPORTED_MODULE_6__["GalleryEditComponent"], _angular_common__WEBPACK_IMPORTED_MODULE_7__["NgIf"]], styles: ["\n/*# sourceMappingURL=data:application/json;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbXSwibmFtZXMiOltdLCJtYXBwaW5ncyI6IiIsImZpbGUiOiJzcmMvYXBwL2hvbWUvaG9tZS10b29sYmFyL2hvbWUtdG9vbGJhci5jb21wb25lbnQuY3NzIn0= */"] });
/*@__PURE__*/ (function () { _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵsetClassMetadata"](HomeToolbarComponent, [{
        type: _angular_core__WEBPACK_IMPORTED_MODULE_0__["Component"],
        args: [{
                selector: 'home-toolbar',
                templateUrl: './home-toolbar.component.html',
                styleUrls: ['./home-toolbar.component.css']
            }]
    }], function () { return [{ type: _services_data_service__WEBPACK_IMPORTED_MODULE_1__["DataService"] }, { type: _services_button_click_service__WEBPACK_IMPORTED_MODULE_2__["ButtonClickService"] }, { type: _services_gallery_service__WEBPACK_IMPORTED_MODULE_3__["GalleryService"] }, { type: _services_identity_service__WEBPACK_IMPORTED_MODULE_5__["IdentityService"] }, { type: _angular_router__WEBPACK_IMPORTED_MODULE_4__["Router"] }]; }, null); })();


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
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @angular/core */ "./node_modules/@angular/core/__ivy_ngcc__/fesm2015/core.js");
/* harmony import */ var _services_button_click_service__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../../services/button-click.service */ "./src/app/services/button-click.service.ts");
/* harmony import */ var _angular_router__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @angular/router */ "./node_modules/@angular/router/__ivy_ngcc__/fesm2015/router.js");
/* harmony import */ var _services_image_service__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../../services/image_service */ "./src/app/services/image_service.ts");
/* harmony import */ var _angular_forms__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! @angular/forms */ "./node_modules/@angular/forms/__ivy_ngcc__/fesm2015/forms.js");
/* harmony import */ var _angular_common__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! @angular/common */ "./node_modules/@angular/common/__ivy_ngcc__/fesm2015/common.js");
/* harmony import */ var primeng_fileupload__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! primeng/fileupload */ "./node_modules/primeng/__ivy_ngcc__/fesm2015/primeng-fileupload.js");
/* harmony import */ var primeng_api__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(/*! primeng/api */ "./node_modules/primeng/__ivy_ngcc__/fesm2015/primeng-api.js");












function ImageAddComponent_option_21_Template(rf, ctx) { if (rf & 1) {
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementStart"](0, "option", 21);
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵtext"](1);
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementEnd"]();
} if (rf & 2) {
    const tag_r2 = ctx.$implicit;
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵpropertyInterpolate"]("value", tag_r2.id);
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵadvance"](1);
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵtextInterpolate"](tag_r2.name);
} }
function ImageAddComponent_ng_template_27_ul_0_li_1_Template(rf, ctx) { if (rf & 1) {
    const _r7 = _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵgetCurrentView"]();
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementStart"](0, "li");
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelement"](1, "img", 25);
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵtext"](2);
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementStart"](3, "a", 26);
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵlistener"]("click", function ImageAddComponent_ng_template_27_ul_0_li_1_Template_a_click_3_listener($event) { _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵrestoreView"](_r7); const file_r5 = ctx.$implicit; const ctx_r6 = _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵnextContext"](3); return ctx_r6.fileDelete($event, file_r5); });
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelement"](4, "span", 27);
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementEnd"]();
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementEnd"]();
} if (rf & 2) {
    const file_r5 = ctx.$implicit;
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵadvance"](1);
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵpropertyInterpolate1"]("src", "/image/uploaded/", file_r5.hash, "", _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵsanitizeUrl"]);
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵadvance"](1);
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵtextInterpolate2"](" ", file_r5.name, " - ", file_r5.size, " bytes ");
} }
function ImageAddComponent_ng_template_27_ul_0_Template(rf, ctx) { if (rf & 1) {
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementStart"](0, "ul", 23);
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵtemplate"](1, ImageAddComponent_ng_template_27_ul_0_li_1_Template, 5, 3, "li", 24);
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementEnd"]();
} if (rf & 2) {
    const ctx_r3 = _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵnextContext"](2);
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵadvance"](1);
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵproperty"]("ngForOf", ctx_r3.uploadedFiles);
} }
function ImageAddComponent_ng_template_27_Template(rf, ctx) { if (rf & 1) {
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵtemplate"](0, ImageAddComponent_ng_template_27_ul_0_Template, 2, 1, "ul", 22);
} if (rf & 2) {
    const ctx_r1 = _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵnextContext"]();
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵproperty"]("ngIf", ctx_r1.uploadedFiles.length);
} }
class ImageAddComponent {
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
}
ImageAddComponent.ɵfac = function ImageAddComponent_Factory(t) { return new (t || ImageAddComponent)(_angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵdirectiveInject"](_services_button_click_service__WEBPACK_IMPORTED_MODULE_1__["ButtonClickService"]), _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵdirectiveInject"](_services_image_service__WEBPACK_IMPORTED_MODULE_3__["ImageService"]), _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵdirectiveInject"](_angular_router__WEBPACK_IMPORTED_MODULE_2__["Router"])); };
ImageAddComponent.ɵcmp = _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵdefineComponent"]({ type: ImageAddComponent, selectors: [["image-add"]], inputs: { gallery: "gallery" }, decls: 32, vars: 2, consts: [["id", "add-modal", 1, "modal", "fade"], [1, "modal-dialog"], [1, "modal-content"], [1, "modal-header"], ["type", "button", "data-dismiss", "modal", "aria-label", "Close", 1, "close"], ["aria-hidden", "true"], [1, "modal-title"], ["action", "", "method", "post", 1, "form-horizontal"], [1, "modal-body"], [1, "form-group"], ["for", "inputImageDescription", 1, "col-sm-2", "control-label"], [1, "col-sm-10"], ["name", "inputImageDescription", "id", "inputImageDescription", "placeholder", "Edit...", 1, "form-control", 3, "ngModel", "ngModelChange"], ["for", "inputImageTags", 1, "col-sm-2", "control-label"], ["name", "inputImageTags[]", "id", "inputImageTags", "multiple", "", 1, "form-control", 2, "width", "100%"], ["selected", "selected", 3, "value", 4, "ngFor", "ngForOf"], ["url", "/api/upload", "name", "myfile[]", "accept", "image/*", "auto", "auto", "multiple", "multiple", 3, "onUpload"], ["pTemplate", "content"], [1, "modal-footer"], ["type", "button", "data-dismiss", "modal", 1, "btn", "btn-default"], ["type", "submit", "value", "Save changes", 1, "btn", "btn-primary", 3, "click"], ["selected", "selected", 3, "value"], ["class", "list-unstyled uploaded-image-list", 4, "ngIf"], [1, "list-unstyled", "uploaded-image-list"], [4, "ngFor", "ngForOf"], ["width", "50", 3, "src"], ["href", "#", 3, "click"], [1, "glyphicon", "glyphicon-trash"]], template: function ImageAddComponent_Template(rf, ctx) { if (rf & 1) {
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementStart"](0, "div", 0);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementStart"](1, "div", 1);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementStart"](2, "div", 2);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementStart"](3, "div", 3);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementStart"](4, "button", 4);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementStart"](5, "span", 5);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵtext"](6, "\u00D7");
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementEnd"]();
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementEnd"]();
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementStart"](7, "h4", 6);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵtext"](8, "Add image");
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementEnd"]();
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementEnd"]();
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementStart"](9, "form", 7);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementStart"](10, "div", 8);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementStart"](11, "div", 9);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementStart"](12, "label", 10);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵtext"](13, "Description");
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementEnd"]();
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementStart"](14, "div", 11);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementStart"](15, "textarea", 12);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵlistener"]("ngModelChange", function ImageAddComponent_Template_textarea_ngModelChange_15_listener($event) { return ctx.description = $event; });
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementEnd"]();
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementEnd"]();
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementEnd"]();
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementStart"](16, "div", 9);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementStart"](17, "label", 13);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵtext"](18, "Tags");
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementEnd"]();
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementStart"](19, "div", 11);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementStart"](20, "select", 14);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵtemplate"](21, ImageAddComponent_option_21_Template, 2, 2, "option", 15);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementEnd"]();
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementEnd"]();
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementEnd"]();
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementStart"](22, "div", 9);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementStart"](23, "label", 13);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵtext"](24, "Image");
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementEnd"]();
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementStart"](25, "div", 11);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementStart"](26, "p-fileUpload", 16);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵlistener"]("onUpload", function ImageAddComponent_Template_p_fileUpload_onUpload_26_listener($event) { return ctx.onUpload($event); });
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵtemplate"](27, ImageAddComponent_ng_template_27_Template, 1, 1, "ng-template", 17);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementEnd"]();
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementEnd"]();
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementEnd"]();
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementEnd"]();
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementStart"](28, "div", 18);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementStart"](29, "button", 19);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵtext"](30, "Close");
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementEnd"]();
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementStart"](31, "input", 20);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵlistener"]("click", function ImageAddComponent_Template_input_click_31_listener() { return ctx.onSubmit(); });
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementEnd"]();
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementEnd"]();
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementEnd"]();
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementEnd"]();
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementEnd"]();
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementEnd"]();
    } if (rf & 2) {
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵadvance"](15);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵproperty"]("ngModel", ctx.description);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵadvance"](6);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵproperty"]("ngForOf", ctx.tagList);
    } }, directives: [_angular_forms__WEBPACK_IMPORTED_MODULE_4__["ɵangular_packages_forms_forms_y"], _angular_forms__WEBPACK_IMPORTED_MODULE_4__["NgControlStatusGroup"], _angular_forms__WEBPACK_IMPORTED_MODULE_4__["NgForm"], _angular_forms__WEBPACK_IMPORTED_MODULE_4__["DefaultValueAccessor"], _angular_forms__WEBPACK_IMPORTED_MODULE_4__["NgControlStatus"], _angular_forms__WEBPACK_IMPORTED_MODULE_4__["NgModel"], _angular_common__WEBPACK_IMPORTED_MODULE_5__["NgForOf"], primeng_fileupload__WEBPACK_IMPORTED_MODULE_6__["FileUpload"], primeng_api__WEBPACK_IMPORTED_MODULE_7__["PrimeTemplate"], _angular_forms__WEBPACK_IMPORTED_MODULE_4__["NgSelectOption"], _angular_forms__WEBPACK_IMPORTED_MODULE_4__["ɵangular_packages_forms_forms_x"], _angular_common__WEBPACK_IMPORTED_MODULE_5__["NgIf"]], styles: [".uploaded-image-list[_ngcontent-%COMP%]   li[_ngcontent-%COMP%] {\n    padding: 5px 10px;\n}\n\n.uploaded-image-list[_ngcontent-%COMP%]   li[_ngcontent-%COMP%]   img[_ngcontent-%COMP%] {\n    padding-right: 10px;\n}\n/*# sourceMappingURL=data:application/json;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbInNyYy9hcHAvaW1hZ2UvaW1hZ2UtYWRkL2ltYWdlLWFkZC5jb21wb25lbnQuY3NzIl0sIm5hbWVzIjpbXSwibWFwcGluZ3MiOiJBQUFBO0lBQ0ksaUJBQWlCO0FBQ3JCOztBQUVBO0lBQ0ksbUJBQW1CO0FBQ3ZCIiwiZmlsZSI6InNyYy9hcHAvaW1hZ2UvaW1hZ2UtYWRkL2ltYWdlLWFkZC5jb21wb25lbnQuY3NzIiwic291cmNlc0NvbnRlbnQiOlsiLnVwbG9hZGVkLWltYWdlLWxpc3QgbGkge1xuICAgIHBhZGRpbmc6IDVweCAxMHB4O1xufVxuXG4udXBsb2FkZWQtaW1hZ2UtbGlzdCBsaSBpbWcge1xuICAgIHBhZGRpbmctcmlnaHQ6IDEwcHg7XG59Il19 */"] });
/*@__PURE__*/ (function () { _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵsetClassMetadata"](ImageAddComponent, [{
        type: _angular_core__WEBPACK_IMPORTED_MODULE_0__["Component"],
        args: [{
                selector: 'image-add',
                templateUrl: './image-add.component.html',
                styleUrls: ['./image-add.component.css']
            }]
    }], function () { return [{ type: _services_button_click_service__WEBPACK_IMPORTED_MODULE_1__["ButtonClickService"] }, { type: _services_image_service__WEBPACK_IMPORTED_MODULE_3__["ImageService"] }, { type: _angular_router__WEBPACK_IMPORTED_MODULE_2__["Router"] }]; }, { gallery: [{
            type: _angular_core__WEBPACK_IMPORTED_MODULE_0__["Input"]
        }] }); })();


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
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @angular/core */ "./node_modules/@angular/core/__ivy_ngcc__/fesm2015/core.js");
/* harmony import */ var _services_button_click_service__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../../services/button-click.service */ "./src/app/services/button-click.service.ts");
/* harmony import */ var _angular_router__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @angular/router */ "./node_modules/@angular/router/__ivy_ngcc__/fesm2015/router.js");
/* harmony import */ var _services_image_service__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../../services/image_service */ "./src/app/services/image_service.ts");
/* harmony import */ var _angular_forms__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! @angular/forms */ "./node_modules/@angular/forms/__ivy_ngcc__/fesm2015/forms.js");
/* harmony import */ var _angular_common__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! @angular/common */ "./node_modules/@angular/common/__ivy_ngcc__/fesm2015/common.js");










function ImageEditComponent_option_21_Template(rf, ctx) { if (rf & 1) {
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementStart"](0, "option", 19);
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵtext"](1);
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementEnd"]();
} if (rf & 2) {
    const tag_r1 = ctx.$implicit;
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵpropertyInterpolate"]("value", tag_r1.id);
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵadvance"](1);
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵtextInterpolate"](tag_r1.name);
} }
class ImageEditComponent {
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
}
ImageEditComponent.ɵfac = function ImageEditComponent_Factory(t) { return new (t || ImageEditComponent)(_angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵdirectiveInject"](_services_button_click_service__WEBPACK_IMPORTED_MODULE_1__["ButtonClickService"]), _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵdirectiveInject"](_services_image_service__WEBPACK_IMPORTED_MODULE_3__["ImageService"]), _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵdirectiveInject"](_angular_router__WEBPACK_IMPORTED_MODULE_2__["Router"])); };
ImageEditComponent.ɵcmp = _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵdefineComponent"]({ type: ImageEditComponent, selectors: [["image-edit"]], inputs: { image: "image" }, decls: 26, vars: 2, consts: [["id", "edit-modal", 1, "modal", "fade"], [1, "modal-dialog"], [1, "modal-content"], [1, "modal-header"], ["type", "button", "data-dismiss", "modal", "aria-label", "Close", 1, "close"], ["aria-hidden", "true"], [1, "modal-title"], ["action", "", "method", "post", 1, "form-horizontal"], [1, "modal-body"], [1, "form-group"], ["for", "inputImageDescription", 1, "col-sm-2", "control-label"], [1, "col-sm-10"], ["name", "inputImageDescription", "id", "inputImageDescription", "placeholder", "Edit...", 1, "form-control", 3, "ngModel", "ngModelChange"], ["for", "inputImageTags", 1, "col-sm-2", "control-label"], ["name", "inputImageTags[]", "id", "inputImageTags", "multiple", "", 1, "form-control", 2, "width", "100%"], ["selected", "selected", 3, "value", 4, "ngFor", "ngForOf"], [1, "modal-footer"], ["type", "button", "data-dismiss", "modal", 1, "btn", "btn-default"], ["type", "submit", "value", "Save changes", 1, "btn", "btn-primary", 3, "click"], ["selected", "selected", 3, "value"]], template: function ImageEditComponent_Template(rf, ctx) { if (rf & 1) {
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementStart"](0, "div", 0);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementStart"](1, "div", 1);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementStart"](2, "div", 2);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementStart"](3, "div", 3);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementStart"](4, "button", 4);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementStart"](5, "span", 5);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵtext"](6, "\u00D7");
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementEnd"]();
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementEnd"]();
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementStart"](7, "h4", 6);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵtext"](8, "Edit image");
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementEnd"]();
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementEnd"]();
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementStart"](9, "form", 7);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementStart"](10, "div", 8);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementStart"](11, "div", 9);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementStart"](12, "label", 10);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵtext"](13, "Description");
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementEnd"]();
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementStart"](14, "div", 11);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementStart"](15, "textarea", 12);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵlistener"]("ngModelChange", function ImageEditComponent_Template_textarea_ngModelChange_15_listener($event) { return ctx.description = $event; });
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementEnd"]();
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementEnd"]();
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementEnd"]();
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementStart"](16, "div", 9);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementStart"](17, "label", 13);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵtext"](18, "Tags");
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementEnd"]();
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementStart"](19, "div", 11);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementStart"](20, "select", 14);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵtemplate"](21, ImageEditComponent_option_21_Template, 2, 2, "option", 15);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementEnd"]();
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementEnd"]();
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementEnd"]();
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementEnd"]();
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementStart"](22, "div", 16);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementStart"](23, "button", 17);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵtext"](24, "Close");
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementEnd"]();
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementStart"](25, "input", 18);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵlistener"]("click", function ImageEditComponent_Template_input_click_25_listener() { return ctx.onSubmit(); });
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementEnd"]();
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementEnd"]();
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementEnd"]();
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementEnd"]();
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementEnd"]();
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementEnd"]();
    } if (rf & 2) {
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵadvance"](15);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵproperty"]("ngModel", ctx.description);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵadvance"](6);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵproperty"]("ngForOf", ctx.tagList);
    } }, directives: [_angular_forms__WEBPACK_IMPORTED_MODULE_4__["ɵangular_packages_forms_forms_y"], _angular_forms__WEBPACK_IMPORTED_MODULE_4__["NgControlStatusGroup"], _angular_forms__WEBPACK_IMPORTED_MODULE_4__["NgForm"], _angular_forms__WEBPACK_IMPORTED_MODULE_4__["DefaultValueAccessor"], _angular_forms__WEBPACK_IMPORTED_MODULE_4__["NgControlStatus"], _angular_forms__WEBPACK_IMPORTED_MODULE_4__["NgModel"], _angular_common__WEBPACK_IMPORTED_MODULE_5__["NgForOf"], _angular_forms__WEBPACK_IMPORTED_MODULE_4__["NgSelectOption"], _angular_forms__WEBPACK_IMPORTED_MODULE_4__["ɵangular_packages_forms_forms_x"]], styles: ["\n/*# sourceMappingURL=data:application/json;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbXSwibmFtZXMiOltdLCJtYXBwaW5ncyI6IiIsImZpbGUiOiJzcmMvYXBwL2ltYWdlL2ltYWdlLWVkaXQvaW1hZ2UtZWRpdC5jb21wb25lbnQuY3NzIn0= */"] });
/*@__PURE__*/ (function () { _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵsetClassMetadata"](ImageEditComponent, [{
        type: _angular_core__WEBPACK_IMPORTED_MODULE_0__["Component"],
        args: [{
                selector: 'image-edit',
                templateUrl: './image-edit.component.html',
                styleUrls: ['./image-edit.component.css']
            }]
    }], function () { return [{ type: _services_button_click_service__WEBPACK_IMPORTED_MODULE_1__["ButtonClickService"] }, { type: _services_image_service__WEBPACK_IMPORTED_MODULE_3__["ImageService"] }, { type: _angular_router__WEBPACK_IMPORTED_MODULE_2__["Router"] }]; }, { image: [{
            type: _angular_core__WEBPACK_IMPORTED_MODULE_0__["Input"]
        }] }); })();


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
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @angular/core */ "./node_modules/@angular/core/__ivy_ngcc__/fesm2015/core.js");
/* harmony import */ var _services_data_service__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../../services/data.service */ "./src/app/services/data.service.ts");
/* harmony import */ var _ngbox_ngbox_directive__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../ngbox/ngbox.directive */ "./src/app/ngbox/ngbox.directive.ts");
/* harmony import */ var _ngbox_ngbox_component__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../../ngbox/ngbox.component */ "./src/app/ngbox/ngbox.component.ts");






class ImageInfoComponent {
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
}
ImageInfoComponent.ɵfac = function ImageInfoComponent_Factory(t) { return new (t || ImageInfoComponent)(_angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵdirectiveInject"](_services_data_service__WEBPACK_IMPORTED_MODULE_1__["DataService"])); };
ImageInfoComponent.ɵcmp = _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵdefineComponent"]({ type: ImageInfoComponent, selectors: [["image-info"]], decls: 12, vars: 5, consts: [[1, "moa-page"], [1, "image-container"], ["ng-box", "", 1, "image-lightbox-link", 3, "href", "title"], [3, "src"], [1, "row"], ["target", "_blank", 1, "btn", "btn-info", "col-md-2", "col-md-offset-5", 3, "href"], [1, "glyphicon", "glyphicon-new-window", "pull-left"]], template: function ImageInfoComponent_Template(rf, ctx) { if (rf & 1) {
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementStart"](0, "div", 0);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementStart"](1, "p");
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵtext"](2);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementEnd"]();
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementStart"](3, "div", 1);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementStart"](4, "a", 2);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelement"](5, "img", 3);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementEnd"]();
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementEnd"]();
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelement"](6, "br");
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementStart"](7, "div", 4);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementStart"](8, "a", 5);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelement"](9, "span", 6);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵtext"](10, " Open in new tab ");
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementEnd"]();
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementEnd"]();
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementEnd"]();
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelement"](11, "ngbox");
    } if (rf & 2) {
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵadvance"](2);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵtextInterpolate1"](" ", ctx.image.description, " ");
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵadvance"](2);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵproperty"]("href", ctx.getFullImageUrl(), _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵsanitizeUrl"])("title", ctx.image.filename);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵadvance"](1);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵpropertyInterpolate"]("src", ctx.image.image_src, _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵsanitizeUrl"]);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵadvance"](3);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵproperty"]("href", ctx.getFullImageUrl(), _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵsanitizeUrl"]);
    } }, directives: [_ngbox_ngbox_directive__WEBPACK_IMPORTED_MODULE_2__["NgBoxDirective"], _ngbox_ngbox_component__WEBPACK_IMPORTED_MODULE_3__["NgBoxComponent"]], styles: [".moa-page[_ngcontent-%COMP%] {\n    width: 1140px;\n}\n\n.image-container[_ngcontent-%COMP%] {\n    text-align: center;\n}\n\n.image-lightbox-link[_ngcontent-%COMP%] {\n    text-align: center;\n    cursor: pointer;\n}\n/*# sourceMappingURL=data:application/json;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbInNyYy9hcHAvaW1hZ2UvaW1hZ2UtaW5mby9pbWFnZS1pbmZvLmNvbXBvbmVudC5jc3MiXSwibmFtZXMiOltdLCJtYXBwaW5ncyI6IkFBQUE7SUFDSSxhQUFhO0FBQ2pCOztBQUVBO0lBQ0ksa0JBQWtCO0FBQ3RCOztBQUVBO0lBQ0ksa0JBQWtCO0lBQ2xCLGVBQWU7QUFDbkIiLCJmaWxlIjoic3JjL2FwcC9pbWFnZS9pbWFnZS1pbmZvL2ltYWdlLWluZm8uY29tcG9uZW50LmNzcyIsInNvdXJjZXNDb250ZW50IjpbIi5tb2EtcGFnZSB7XG4gICAgd2lkdGg6IDExNDBweDtcbn1cblxuLmltYWdlLWNvbnRhaW5lciB7XG4gICAgdGV4dC1hbGlnbjogY2VudGVyO1xufVxuXG4uaW1hZ2UtbGlnaHRib3gtbGluayB7XG4gICAgdGV4dC1hbGlnbjogY2VudGVyO1xuICAgIGN1cnNvcjogcG9pbnRlcjtcbn0iXX0= */"] });
/*@__PURE__*/ (function () { _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵsetClassMetadata"](ImageInfoComponent, [{
        type: _angular_core__WEBPACK_IMPORTED_MODULE_0__["Component"],
        args: [{
                selector: 'image-info',
                templateUrl: './image-info.component.html',
                styleUrls: ['./image-info.component.css']
            }]
    }], function () { return [{ type: _services_data_service__WEBPACK_IMPORTED_MODULE_1__["DataService"] }]; }, null); })();


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
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @angular/core */ "./node_modules/@angular/core/__ivy_ngcc__/fesm2015/core.js");
/* harmony import */ var _services_data_service__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../../services/data.service */ "./src/app/services/data.service.ts");
/* harmony import */ var _services_thumbnail_service__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../services/thumbnail.service */ "./src/app/services/thumbnail.service.ts");
/* harmony import */ var _angular_common__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @angular/common */ "./node_modules/@angular/common/__ivy_ngcc__/fesm2015/common.js");
/* harmony import */ var _image_thumb_image_thumb_component__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ../image-thumb/image-thumb.component */ "./src/app/image/image-thumb/image-thumb.component.ts");








function ImageListComponent_li_1_Template(rf, ctx) { if (rf & 1) {
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementStart"](0, "li", 2);
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelement"](1, "image-thumb", 3);
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementEnd"]();
} if (rf & 2) {
    const image_r1 = ctx.$implicit;
    const ctx_r0 = _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵnextContext"]();
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵadvance"](1);
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵproperty"]("image", image_r1)("gallery_id", ctx_r0.gallery.id);
} }
class ImageListComponent {
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
                let width = image.width * (Number(ImageListComponent.TARGET_HEIGHT) / image.height);
                imageWidths.push(width);
                totalWidth += width;
            }
            if (toGenerate.length > 0)
                this.getThumbs(toGenerate);
            let maxWidth = Number(ImageListComponent.GALLERY_WIDTH) * 1.2;
            let rows = [];
            let row = {
                width: 0,
                images: 0
            };
            let i = 0;
            while (i < imageWidths.length) {
                row.width += imageWidths[i];
                row.images++;
                if ((row.width > ImageListComponent.GALLERY_WIDTH) &&
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
                let scaleFactor = Number(ImageListComponent.GALLERY_WIDTH) / row.width;
                for (let j = 0; j < row.images; j++) {
                    this.images[i].displayWidth = Math.floor(imageWidths[i] * scaleFactor);
                    this.images[i].displayHeight = Math.floor(Number(ImageListComponent.TARGET_HEIGHT) * scaleFactor);
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
}
ImageListComponent.TARGET_HEIGHT = 300;
ImageListComponent.GALLERY_WIDTH = 1140;
ImageListComponent.ɵfac = function ImageListComponent_Factory(t) { return new (t || ImageListComponent)(_angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵdirectiveInject"](_services_data_service__WEBPACK_IMPORTED_MODULE_1__["DataService"]), _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵdirectiveInject"](_services_thumbnail_service__WEBPACK_IMPORTED_MODULE_2__["ThumbnailService"])); };
ImageListComponent.ɵcmp = _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵdefineComponent"]({ type: ImageListComponent, selectors: [["image-list"]], decls: 2, vars: 1, consts: [[1, "list-unstyled", 2, "overflow", "auto"], ["class", "thumbnail", 4, "ngFor", "ngForOf"], [1, "thumbnail"], [3, "image", "gallery_id"]], template: function ImageListComponent_Template(rf, ctx) { if (rf & 1) {
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementStart"](0, "ul", 0);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵtemplate"](1, ImageListComponent_li_1_Template, 2, 2, "li", 1);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementEnd"]();
    } if (rf & 2) {
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵadvance"](1);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵproperty"]("ngForOf", ctx.images);
    } }, directives: [_angular_common__WEBPACK_IMPORTED_MODULE_3__["NgForOf"], _image_thumb_image_thumb_component__WEBPACK_IMPORTED_MODULE_4__["ImageThumbComponent"]], styles: [".thumbnail[_ngcontent-%COMP%] {\n    \n    display: inline-block;\n    margin-bottom: 0;\n    position: relative;\n}\n\n.cdk-drag-placeholder[_ngcontent-%COMP%] {\n    \n}\n\n.example-custom-placeholder[_ngcontent-%COMP%] {\n    width: 300px;\n    height: 300px;\n    border: 1px dashed black;\n    background-color: white;\n}\n/*# sourceMappingURL=data:application/json;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbInNyYy9hcHAvaW1hZ2UvaW1hZ2UtbGlzdC9pbWFnZS1saXN0LmNvbXBvbmVudC5jc3MiXSwibmFtZXMiOltdLCJtYXBwaW5ncyI6IkFBQUE7SUFDSSxlQUFlO0lBQ2YscUJBQXFCO0lBQ3JCLGdCQUFnQjtJQUNoQixrQkFBa0I7QUFDdEI7O0FBRUE7SUFDSTtrQkFDYztBQUNsQjs7QUFFQTtJQUNJLFlBQVk7SUFDWixhQUFhO0lBQ2Isd0JBQXdCO0lBQ3hCLHVCQUF1QjtBQUMzQiIsImZpbGUiOiJzcmMvYXBwL2ltYWdlL2ltYWdlLWxpc3QvaW1hZ2UtbGlzdC5jb21wb25lbnQuY3NzIiwic291cmNlc0NvbnRlbnQiOlsiLnRodW1ibmFpbCB7XG4gICAgLypmbG9hdDogbGVmdDsqL1xuICAgIGRpc3BsYXk6IGlubGluZS1ibG9jaztcbiAgICBtYXJnaW4tYm90dG9tOiAwO1xuICAgIHBvc2l0aW9uOiByZWxhdGl2ZTtcbn1cblxuLmNkay1kcmFnLXBsYWNlaG9sZGVyIHtcbiAgICAvKndpZHRoOiAxMDAlO1xuICAgIGhlaWdodDogMTAwJTsqL1xufVxuXG4uZXhhbXBsZS1jdXN0b20tcGxhY2Vob2xkZXIge1xuICAgIHdpZHRoOiAzMDBweDtcbiAgICBoZWlnaHQ6IDMwMHB4O1xuICAgIGJvcmRlcjogMXB4IGRhc2hlZCBibGFjaztcbiAgICBiYWNrZ3JvdW5kLWNvbG9yOiB3aGl0ZTtcbn1cbiJdfQ== */"] });
/*@__PURE__*/ (function () { _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵsetClassMetadata"](ImageListComponent, [{
        type: _angular_core__WEBPACK_IMPORTED_MODULE_0__["Component"],
        args: [{
                selector: 'image-list',
                templateUrl: './image-list.component.html',
                styleUrls: ['./image-list.component.css']
            }]
    }], function () { return [{ type: _services_data_service__WEBPACK_IMPORTED_MODULE_1__["DataService"] }, { type: _services_thumbnail_service__WEBPACK_IMPORTED_MODULE_2__["ThumbnailService"] }]; }, null); })();


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
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @angular/core */ "./node_modules/@angular/core/__ivy_ngcc__/fesm2015/core.js");
/* harmony import */ var _services_gallery_service__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../../services/gallery_service */ "./src/app/services/gallery_service.ts");
/* harmony import */ var _angular_router__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @angular/router */ "./node_modules/@angular/router/__ivy_ngcc__/fesm2015/router.js");
/* harmony import */ var _angular_common__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @angular/common */ "./node_modules/@angular/common/__ivy_ngcc__/fesm2015/common.js");







function ImageThumbComponent_div_1_Template(rf, ctx) { if (rf & 1) {
    const _r6 = _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵgetCurrentView"]();
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementStart"](0, "div", 6);
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵlistener"]("drop", function ImageThumbComponent_div_1_Template_div_drop_0_listener($event) { _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵrestoreView"](_r6); const ctx_r5 = _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵnextContext"](); return ctx_r5.onDrop($event); });
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementStart"](1, "span");
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵtext"](2, "<<");
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementEnd"]();
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementEnd"]();
} }
function ImageThumbComponent_div_2_Template(rf, ctx) { if (rf & 1) {
    const _r8 = _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵgetCurrentView"]();
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementStart"](0, "div", 7);
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵlistener"]("drop", function ImageThumbComponent_div_2_Template_div_drop_0_listener($event) { _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵrestoreView"](_r8); const ctx_r7 = _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵnextContext"](); return ctx_r7.onDrop($event); });
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementStart"](1, "span");
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵtext"](2, ">>");
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementEnd"]();
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementEnd"]();
} }
const _c0 = function (a0, a1) { return { width: a0, height: a1 }; };
function ImageThumbComponent_img_4_Template(rf, ctx) { if (rf & 1) {
    const _r10 = _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵgetCurrentView"]();
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementStart"](0, "img", 8);
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵlistener"]("dragstart", function ImageThumbComponent_img_4_Template_img_dragstart_0_listener($event) { _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵrestoreView"](_r10); const ctx_r9 = _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵnextContext"](); return ctx_r9.onDrag($event, ctx_r9.image.id); });
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementEnd"]();
} if (rf & 2) {
    const ctx_r2 = _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵnextContext"]();
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵpropertyInterpolate1"]("src", "/image/thumb/", ctx_r2.image.id, ".jpg", _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵsanitizeUrl"]);
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵproperty"]("ngStyle", _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵpureFunction2"](2, _c0, ctx_r2.image.displayWidth - 10 + "px", ctx_r2.image.displayHeight + "px"));
} }
function ImageThumbComponent_img_5_Template(rf, ctx) { if (rf & 1) {
    const _r12 = _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵgetCurrentView"]();
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementStart"](0, "img", 8);
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵlistener"]("dragstart", function ImageThumbComponent_img_5_Template_img_dragstart_0_listener($event) { _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵrestoreView"](_r12); const ctx_r11 = _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵnextContext"](); return ctx_r11.onDrag($event, ctx_r11.image.id); });
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementEnd"]();
} if (rf & 2) {
    const ctx_r3 = _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵnextContext"]();
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵpropertyInterpolate1"]("src", "/image/thumb/", ctx_r3.image.id, "-w.jpg", _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵsanitizeUrl"]);
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵproperty"]("ngStyle", _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵpureFunction2"](2, _c0, ctx_r3.image.displayWidth - 10 + "px", ctx_r3.image.displayHeight + "px"));
} }
function ImageThumbComponent_img_6_Template(rf, ctx) { if (rf & 1) {
    const _r14 = _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵgetCurrentView"]();
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementStart"](0, "img", 9);
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵlistener"]("dragstart", function ImageThumbComponent_img_6_Template_img_dragstart_0_listener($event) { _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵrestoreView"](_r14); const ctx_r13 = _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵnextContext"](); return ctx_r13.onDrag($event, ctx_r13.image.id); });
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementEnd"]();
} }
const _c1 = function (a0) { return [a0]; };
class ImageThumbComponent {
    constructor(galleryService, router) {
        this.galleryService = galleryService;
        this.router = router;
    }
    getLink() {
        return '/image/' + this.gallery_id + '/' + this.image.id;
    }
    onDragEnter($event) {
        $event.preventDefault();
        $event.stopPropagation();
        if (localStorage.getItem('moaDragId') != this.image.id)
            this.showDropTargets = true;
    }
    onDragLeave($event) {
        $event.preventDefault();
        $event.stopPropagation();
        let element = $event.relatedTarget.closest('.inner-thumbnail');
        if (element !== null) {
            let image_id = element.getAttribute('data-image_id');
            if (image_id != this.image.id)
                this.showDropTargets = false;
        }
        else {
            this.showDropTargets = false;
        }
    }
    onDrag($event, image_id) {
        localStorage.setItem('moaDragType', 'image');
        localStorage.setItem('moaDragId', image_id);
    }
    onDrop($event) {
        let droppedId = localStorage.getItem('moaDragId');
        localStorage.removeItem('moaDragType');
        localStorage.removeItem('moaDragId');
        this.showDropTargets = false;
        let direction = $event.toElement.getAttribute('data-direction');
        if (direction !== null) {
            this.galleryService.MoveImage(this.gallery_id, droppedId, direction, this.image.id).subscribe(data => {
                this.router.navigate(['/gallery/' + this.gallery_id]);
            });
        }
        $event.preventDefault();
        $event.stopPropagation();
    }
    onDragOver($event) {
        $event.preventDefault();
        $event.stopPropagation();
    }
}
ImageThumbComponent.ɵfac = function ImageThumbComponent_Factory(t) { return new (t || ImageThumbComponent)(_angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵdirectiveInject"](_services_gallery_service__WEBPACK_IMPORTED_MODULE_1__["GalleryService"]), _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵdirectiveInject"](_angular_router__WEBPACK_IMPORTED_MODULE_2__["Router"])); };
ImageThumbComponent.ɵcmp = _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵdefineComponent"]({ type: ImageThumbComponent, selectors: [["image-thumb"]], inputs: { image: "image", gallery_id: "gallery_id" }, decls: 7, vars: 9, consts: [[1, "inner-thumbnail", 3, "dragenter", "dragleave", "dragover", "drop"], ["class", "left-dropper", "data-direction", "before", 3, "drop", 4, "ngIf"], ["class", "right-dropper", "data-direction", "after", 3, "drop", 4, "ngIf"], [3, "routerLink"], [3, "src", "ngStyle", "dragstart", 4, "ngIf"], ["src", "/media/spinner.svg", "class", "thumbnail-generating", 3, "dragstart", 4, "ngIf"], ["data-direction", "before", 1, "left-dropper", 3, "drop"], ["data-direction", "after", 1, "right-dropper", 3, "drop"], [3, "src", "ngStyle", "dragstart"], ["src", "/media/spinner.svg", 1, "thumbnail-generating", 3, "dragstart"]], template: function ImageThumbComponent_Template(rf, ctx) { if (rf & 1) {
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementStart"](0, "div", 0);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵlistener"]("dragenter", function ImageThumbComponent_Template_div_dragenter_0_listener($event) { return ctx.onDragEnter($event); })("dragleave", function ImageThumbComponent_Template_div_dragleave_0_listener($event) { return ctx.onDragLeave($event); })("dragover", function ImageThumbComponent_Template_div_dragover_0_listener($event) { return ctx.onDragOver($event); })("drop", function ImageThumbComponent_Template_div_drop_0_listener($event) { return ctx.onDrop($event); });
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵtemplate"](1, ImageThumbComponent_div_1_Template, 3, 0, "div", 1);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵtemplate"](2, ImageThumbComponent_div_2_Template, 3, 0, "div", 2);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementStart"](3, "a", 3);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵtemplate"](4, ImageThumbComponent_img_4_Template, 1, 5, "img", 4);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵtemplate"](5, ImageThumbComponent_img_5_Template, 1, 5, "img", 4);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵtemplate"](6, ImageThumbComponent_img_6_Template, 1, 0, "img", 5);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementEnd"]();
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementEnd"]();
    } if (rf & 2) {
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵattribute"]("data-image_id", ctx.image.id);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵadvance"](1);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵproperty"]("ngIf", ctx.showDropTargets);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵadvance"](1);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵproperty"]("ngIf", ctx.showDropTargets);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵadvance"](1);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵproperty"]("routerLink", _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵpureFunction1"](7, _c1, ctx.getLink()));
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵadvance"](1);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵproperty"]("ngIf", !ctx.image.isGenerating && ctx.image.displayWidth <= 450 && ctx.image.displayHeight <= 300);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵadvance"](1);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵproperty"]("ngIf", !ctx.image.isGenerating && (ctx.image.displayWidth > 450 || ctx.image.displayHeight > 300));
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵadvance"](1);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵproperty"]("ngIf", ctx.image.isGenerating);
    } }, directives: [_angular_common__WEBPACK_IMPORTED_MODULE_3__["NgIf"], _angular_router__WEBPACK_IMPORTED_MODULE_2__["RouterLinkWithHref"], _angular_common__WEBPACK_IMPORTED_MODULE_3__["NgStyle"]], styles: [".thumbnail-generating[_ngcontent-%COMP%] {\n    width: 64px;\n    height: 64px;\n    margin: 62px 109px;\n}\n\n.thumbnail-image-container[_ngcontent-%COMP%] {\n    overflow: hidden;\n    text-align: center;\n    background-color: rgba(0, 0, 0, 0.05);\n}\n\n.inner-thumbnail[_ngcontent-%COMP%]   .left-dropper[_ngcontent-%COMP%] {\n    position: absolute;\n    left: 0;\n    top: 0;\n    height: 100%;\n    width: 50px;\n    background-color: #ccc;\n    opacity: 0.8;\n}\n\n.inner-thumbnail[_ngcontent-%COMP%]   .left-dropper[_ngcontent-%COMP%]   span[_ngcontent-%COMP%] {\n    position: absolute;\n    top: 50%;\n    left: 50%;\n    margin-top: -50%;\n    margin-left: -50%;\n}\n\n.inner-thumbnail[_ngcontent-%COMP%]   .right-dropper[_ngcontent-%COMP%] {\n\tposition: absolute;\n\tright: 0;\n\ttop: 0;\n\theight: 100%;\n\twidth: 50px;\n\tbackground-color: #ccc;\n\topacity: 0.8;\n}\n\n.inner-thumbnail[_ngcontent-%COMP%]   .right-dropper[_ngcontent-%COMP%]   span[_ngcontent-%COMP%] {\n\tposition: absolute;\n\ttop: 50%;\n\tleft: 50%;\n\tmargin-top: -50%;\n\tmargin-left: -50%;\n}\n/*# sourceMappingURL=data:application/json;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbInNyYy9hcHAvaW1hZ2UvaW1hZ2UtdGh1bWIvaW1hZ2UtdGh1bWIuY29tcG9uZW50LmNzcyJdLCJuYW1lcyI6W10sIm1hcHBpbmdzIjoiQUFBQTtJQUNJLFdBQVc7SUFDWCxZQUFZO0lBQ1osa0JBQWtCO0FBQ3RCOztBQUVBO0lBQ0ksZ0JBQWdCO0lBQ2hCLGtCQUFrQjtJQUNsQixxQ0FBcUM7QUFDekM7O0FBRUE7SUFDSSxrQkFBa0I7SUFDbEIsT0FBTztJQUNQLE1BQU07SUFDTixZQUFZO0lBQ1osV0FBVztJQUNYLHNCQUFzQjtJQUN0QixZQUFZO0FBQ2hCOztBQUVBO0lBQ0ksa0JBQWtCO0lBQ2xCLFFBQVE7SUFDUixTQUFTO0lBQ1QsZ0JBQWdCO0lBQ2hCLGlCQUFpQjtBQUNyQjs7QUFFQTtDQUNDLGtCQUFrQjtDQUNsQixRQUFRO0NBQ1IsTUFBTTtDQUNOLFlBQVk7Q0FDWixXQUFXO0NBQ1gsc0JBQXNCO0NBQ3RCLFlBQVk7QUFDYjs7QUFFQTtDQUNDLGtCQUFrQjtDQUNsQixRQUFRO0NBQ1IsU0FBUztDQUNULGdCQUFnQjtDQUNoQixpQkFBaUI7QUFDbEIiLCJmaWxlIjoic3JjL2FwcC9pbWFnZS9pbWFnZS10aHVtYi9pbWFnZS10aHVtYi5jb21wb25lbnQuY3NzIiwic291cmNlc0NvbnRlbnQiOlsiLnRodW1ibmFpbC1nZW5lcmF0aW5nIHtcbiAgICB3aWR0aDogNjRweDtcbiAgICBoZWlnaHQ6IDY0cHg7XG4gICAgbWFyZ2luOiA2MnB4IDEwOXB4O1xufVxuXG4udGh1bWJuYWlsLWltYWdlLWNvbnRhaW5lciB7XG4gICAgb3ZlcmZsb3c6IGhpZGRlbjtcbiAgICB0ZXh0LWFsaWduOiBjZW50ZXI7XG4gICAgYmFja2dyb3VuZC1jb2xvcjogcmdiYSgwLCAwLCAwLCAwLjA1KTtcbn1cblxuLmlubmVyLXRodW1ibmFpbCAubGVmdC1kcm9wcGVyIHtcbiAgICBwb3NpdGlvbjogYWJzb2x1dGU7XG4gICAgbGVmdDogMDtcbiAgICB0b3A6IDA7XG4gICAgaGVpZ2h0OiAxMDAlO1xuICAgIHdpZHRoOiA1MHB4O1xuICAgIGJhY2tncm91bmQtY29sb3I6ICNjY2M7XG4gICAgb3BhY2l0eTogMC44O1xufVxuXG4uaW5uZXItdGh1bWJuYWlsIC5sZWZ0LWRyb3BwZXIgc3BhbiB7XG4gICAgcG9zaXRpb246IGFic29sdXRlO1xuICAgIHRvcDogNTAlO1xuICAgIGxlZnQ6IDUwJTtcbiAgICBtYXJnaW4tdG9wOiAtNTAlO1xuICAgIG1hcmdpbi1sZWZ0OiAtNTAlO1xufVxuXG4uaW5uZXItdGh1bWJuYWlsIC5yaWdodC1kcm9wcGVyIHtcblx0cG9zaXRpb246IGFic29sdXRlO1xuXHRyaWdodDogMDtcblx0dG9wOiAwO1xuXHRoZWlnaHQ6IDEwMCU7XG5cdHdpZHRoOiA1MHB4O1xuXHRiYWNrZ3JvdW5kLWNvbG9yOiAjY2NjO1xuXHRvcGFjaXR5OiAwLjg7XG59XG5cbi5pbm5lci10aHVtYm5haWwgLnJpZ2h0LWRyb3BwZXIgc3BhbiB7XG5cdHBvc2l0aW9uOiBhYnNvbHV0ZTtcblx0dG9wOiA1MCU7XG5cdGxlZnQ6IDUwJTtcblx0bWFyZ2luLXRvcDogLTUwJTtcblx0bWFyZ2luLWxlZnQ6IC01MCU7XG59XG4iXX0= */"] });
/*@__PURE__*/ (function () { _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵsetClassMetadata"](ImageThumbComponent, [{
        type: _angular_core__WEBPACK_IMPORTED_MODULE_0__["Component"],
        args: [{
                selector: 'image-thumb',
                templateUrl: './image-thumb.component.html',
                styleUrls: ['./image-thumb.component.css']
            }]
    }], function () { return [{ type: _services_gallery_service__WEBPACK_IMPORTED_MODULE_1__["GalleryService"] }, { type: _angular_router__WEBPACK_IMPORTED_MODULE_2__["Router"] }]; }, { image: [{
            type: _angular_core__WEBPACK_IMPORTED_MODULE_0__["Input"]
        }], gallery_id: [{
            type: _angular_core__WEBPACK_IMPORTED_MODULE_0__["Input"]
        }] }); })();


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
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @angular/core */ "./node_modules/@angular/core/__ivy_ngcc__/fesm2015/core.js");
/* harmony import */ var _services_button_click_service__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../../services/button-click.service */ "./src/app/services/button-click.service.ts");
/* harmony import */ var _services_data_service__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../services/data.service */ "./src/app/services/data.service.ts");
/* harmony import */ var _angular_router__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @angular/router */ "./node_modules/@angular/router/__ivy_ngcc__/fesm2015/router.js");
/* harmony import */ var _services_image_service__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ../../services/image_service */ "./src/app/services/image_service.ts");
/* harmony import */ var _services_identity_service__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! ../../services/identity.service */ "./src/app/services/identity.service.ts");
/* harmony import */ var _image_edit_image_edit_component__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! ../image-edit/image-edit.component */ "./src/app/image/image-edit/image-edit.component.ts");
/* harmony import */ var _angular_common__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(/*! @angular/common */ "./node_modules/@angular/common/__ivy_ngcc__/fesm2015/common.js");














function ImageToolbarComponent_div_3_Template(rf, ctx) { if (rf & 1) {
    const _r2 = _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵgetCurrentView"]();
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementStart"](0, "div", 4);
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementStart"](1, "button", 5);
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵlistener"]("click", function ImageToolbarComponent_div_3_Template_button_click_1_listener() { _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵrestoreView"](_r2); const ctx_r1 = _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵnextContext"](); return ctx_r1.onEditClick(); });
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelement"](2, "span", 6);
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementEnd"]();
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementStart"](3, "button", 7);
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵlistener"]("click", function ImageToolbarComponent_div_3_Template_button_click_3_listener() { _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵrestoreView"](_r2); const ctx_r3 = _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵnextContext"](); return ctx_r3.onDeleteClick(); });
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelement"](4, "span", 8);
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementEnd"]();
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementEnd"]();
} }
class ImageToolbarComponent {
    constructor(dataService, buttonClickService, imageService, identityService, router) {
        this.dataService = dataService;
        this.buttonClickService = buttonClickService;
        this.imageService = imageService;
        this.identityService = identityService;
        this.router = router;
        this.image = {
            id: 0,
            name: '',
            description: '',
            gallery_id: 0
        };
        this.rights = {
            isAdmin: false
        };
        this.observer = dataService.getImageObserver().subscribe(data => {
            this.image = data;
        });
        this.rights.isAdmin = identityService.isAdmin();
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
}
ImageToolbarComponent.ɵfac = function ImageToolbarComponent_Factory(t) { return new (t || ImageToolbarComponent)(_angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵdirectiveInject"](_services_data_service__WEBPACK_IMPORTED_MODULE_2__["DataService"]), _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵdirectiveInject"](_services_button_click_service__WEBPACK_IMPORTED_MODULE_1__["ButtonClickService"]), _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵdirectiveInject"](_services_image_service__WEBPACK_IMPORTED_MODULE_4__["ImageService"]), _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵdirectiveInject"](_services_identity_service__WEBPACK_IMPORTED_MODULE_5__["IdentityService"]), _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵdirectiveInject"](_angular_router__WEBPACK_IMPORTED_MODULE_3__["Router"])); };
ImageToolbarComponent.ɵcmp = _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵdefineComponent"]({ type: ImageToolbarComponent, selectors: [["image-toolbar"]], decls: 4, vars: 2, consts: [[3, "image"], [1, "row"], [1, "pull-right"], ["class", "btn-group", "role", "group", "aria-label", "...", 4, "ngIf"], ["role", "group", "aria-label", "...", 1, "btn-group"], ["type", "button", "id", "imageEdit", "title", "Edit image", "data-toggle", "tooltip", 1, "btn", "btn-default", 3, "click"], [1, "glyphicon", "glyphicon-pencil"], ["type", "button", "id", "imageDelete", "title", "Delete image", "data-toggle", "tooltip", 1, "btn", "btn-default", 3, "click"], [1, "glyphicon", "glyphicon-trash"]], template: function ImageToolbarComponent_Template(rf, ctx) { if (rf & 1) {
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelement"](0, "image-edit", 0);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementStart"](1, "div", 1);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementStart"](2, "div", 2);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵtemplate"](3, ImageToolbarComponent_div_3_Template, 5, 0, "div", 3);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementEnd"]();
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementEnd"]();
    } if (rf & 2) {
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵproperty"]("image", ctx.image);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵadvance"](3);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵproperty"]("ngIf", ctx.rights.isAdmin);
    } }, directives: [_image_edit_image_edit_component__WEBPACK_IMPORTED_MODULE_6__["ImageEditComponent"], _angular_common__WEBPACK_IMPORTED_MODULE_7__["NgIf"]], styles: ["\n/*# sourceMappingURL=data:application/json;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbXSwibmFtZXMiOltdLCJtYXBwaW5ncyI6IiIsImZpbGUiOiJzcmMvYXBwL2ltYWdlL2ltYWdlLXRvb2xiYXIvaW1hZ2UtdG9vbGJhci5jb21wb25lbnQuY3NzIn0= */"] });
/*@__PURE__*/ (function () { _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵsetClassMetadata"](ImageToolbarComponent, [{
        type: _angular_core__WEBPACK_IMPORTED_MODULE_0__["Component"],
        args: [{
                selector: 'image-toolbar',
                templateUrl: './image-toolbar.component.html',
                styleUrls: ['./image-toolbar.component.css']
            }]
    }], function () { return [{ type: _services_data_service__WEBPACK_IMPORTED_MODULE_2__["DataService"] }, { type: _services_button_click_service__WEBPACK_IMPORTED_MODULE_1__["ButtonClickService"] }, { type: _services_image_service__WEBPACK_IMPORTED_MODULE_4__["ImageService"] }, { type: _services_identity_service__WEBPACK_IMPORTED_MODULE_5__["IdentityService"] }, { type: _angular_router__WEBPACK_IMPORTED_MODULE_3__["Router"] }]; }, null); })();


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
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @angular/core */ "./node_modules/@angular/core/__ivy_ngcc__/fesm2015/core.js");
/* harmony import */ var _ngbox_service__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./ngbox.service */ "./src/app/ngbox/ngbox.service.ts");
/* harmony import */ var _angular_common__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @angular/common */ "./node_modules/@angular/common/__ivy_ngcc__/fesm2015/common.js");





const _c0 = ["ngBoxContent"];
const _c1 = ["ngBoxButtons"];
function NgBoxComponent_div_0_Template(rf, ctx) { if (rf & 1) {
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementStart"](0, "div", 2);
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelement"](1, "img", 3);
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementEnd"]();
} }
function NgBoxComponent_div_1_img_2_Template(rf, ctx) { if (rf & 1) {
    const _r12 = _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵgetCurrentView"]();
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementStart"](0, "img", 16);
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵlistener"]("click", function NgBoxComponent_div_1_img_2_Template_img_click_0_listener() { _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵrestoreView"](_r12); const ctx_r11 = _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵnextContext"](2); return ctx_r11.previousNgBox(); });
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementEnd"]();
} }
function NgBoxComponent_div_1_img_3_Template(rf, ctx) { if (rf & 1) {
    const _r14 = _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵgetCurrentView"]();
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementStart"](0, "img", 17);
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵlistener"]("click", function NgBoxComponent_div_1_img_3_Template_img_click_0_listener() { _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵrestoreView"](_r14); const ctx_r13 = _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵnextContext"](2); return ctx_r13.nextNgBox(); });
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementEnd"]();
} }
function NgBoxComponent_div_1_img_4_Template(rf, ctx) { if (rf & 1) {
    const _r17 = _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵgetCurrentView"]();
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementStart"](0, "img", 18, 19);
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵlistener"]("load", function NgBoxComponent_div_1_img_4_Template_img_load_0_listener() { _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵrestoreView"](_r17); const ctx_r16 = _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵnextContext"](2); return ctx_r16.isLoaded(); })("click", function NgBoxComponent_div_1_img_4_Template_img_click_0_listener() { _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵrestoreView"](_r17); const ctx_r18 = _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵnextContext"](2); return ctx_r18.nextNgBox(); });
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementEnd"]();
} if (rf & 2) {
    const ctx_r4 = _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵnextContext"](2);
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵproperty"]("src", ctx_r4.ngBox.current.url, _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵsanitizeUrl"])("hidden", ctx_r4.ngBox.loading);
} }
function NgBoxComponent_div_1_iframe_5_Template(rf, ctx) { if (rf & 1) {
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelement"](0, "iframe", 20, 19);
} if (rf & 2) {
    const ctx_r5 = _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵnextContext"](2);
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵpropertyInterpolate"]("width", ctx_r5.ngBox.current.width);
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵpropertyInterpolate"]("height", ctx_r5.ngBox.current.height);
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵproperty"]("src", ctx_r5.ngBox.current.url, _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵsanitizeResourceUrl"]);
} }
function NgBoxComponent_div_1_iframe_6_Template(rf, ctx) { if (rf & 1) {
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelement"](0, "iframe", 21, 19);
} if (rf & 2) {
    const ctx_r6 = _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵnextContext"](2);
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵpropertyInterpolate"]("width", ctx_r6.ngBox.current.width);
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵpropertyInterpolate"]("height", ctx_r6.ngBox.current.height);
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵproperty"]("src", ctx_r6.ngBox.current.url, _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵsanitizeResourceUrl"]);
} }
function NgBoxComponent_div_1_iframe_7_Template(rf, ctx) { if (rf & 1) {
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelement"](0, "iframe", 20, 19);
} if (rf & 2) {
    const ctx_r7 = _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵnextContext"](2);
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵpropertyInterpolate"]("width", ctx_r7.ngBox.current.width);
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵpropertyInterpolate"]("height", ctx_r7.ngBox.current.height);
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵproperty"]("src", ctx_r7.ngBox.current.url, _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵsanitizeResourceUrl"]);
} }
function NgBoxComponent_div_1_span_11_Template(rf, ctx) { if (rf & 1) {
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementStart"](0, "span", 22);
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵtext"](1);
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelement"](2, "br");
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementEnd"]();
} if (rf & 2) {
    const ctx_r9 = _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵnextContext"](2);
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵadvance"](1);
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵtextInterpolate"](ctx_r9.ngBox.current.title);
} }
function NgBoxComponent_div_1_span_12_Template(rf, ctx) { if (rf & 1) {
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementStart"](0, "span", 23);
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵtext"](1);
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementEnd"]();
} if (rf & 2) {
    const ctx_r10 = _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵnextContext"](2);
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵadvance"](1);
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵtextInterpolate2"]("", ctx_r10.getCurrentIndex(), " of ", ctx_r10.getCount(), "");
} }
const _c2 = function (a0) { return { "padding-top": a0 }; };
function NgBoxComponent_div_1_Template(rf, ctx) { if (rf & 1) {
    const _r23 = _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵgetCurrentView"]();
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementStart"](0, "div", 4);
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵlistener"]("click", function NgBoxComponent_div_1_Template_div_click_0_listener($event) { _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵrestoreView"](_r23); const ctx_r22 = _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵnextContext"](); return ctx_r22.closeOutside($event); });
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementStart"](1, "div", 5);
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵtemplate"](2, NgBoxComponent_div_1_img_2_Template, 1, 0, "img", 6);
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵtemplate"](3, NgBoxComponent_div_1_img_3_Template, 1, 0, "img", 7);
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵtemplate"](4, NgBoxComponent_div_1_img_4_Template, 2, 2, "img", 8);
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵtemplate"](5, NgBoxComponent_div_1_iframe_5_Template, 2, 3, "iframe", 9);
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵtemplate"](6, NgBoxComponent_div_1_iframe_6_Template, 2, 3, "iframe", 10);
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵtemplate"](7, NgBoxComponent_div_1_iframe_7_Template, 2, 3, "iframe", 9);
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementEnd"]();
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementStart"](8, "div", 11, 12);
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementStart"](10, "p");
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵtemplate"](11, NgBoxComponent_div_1_span_11_Template, 3, 1, "span", 13);
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵtemplate"](12, NgBoxComponent_div_1_span_12_Template, 2, 2, "span", 14);
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementEnd"]();
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementStart"](13, "img", 15);
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵlistener"]("click", function NgBoxComponent_div_1_Template_img_click_13_listener() { _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵrestoreView"](_r23); const ctx_r24 = _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵnextContext"](); return ctx_r24.closeNgBox(); });
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementEnd"]();
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementEnd"]();
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementEnd"]();
} if (rf & 2) {
    const ctx_r1 = _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵnextContext"]();
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵproperty"]("ngStyle", _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵpureFunction1"](10, _c2, ctx_r1.offsetHeight + "px"));
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵadvance"](2);
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵproperty"]("ngIf", ctx_r1.getHasGroup());
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵadvance"](1);
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵproperty"]("ngIf", ctx_r1.getHasGroup());
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵadvance"](1);
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵproperty"]("ngIf", ctx_r1.ngBox.current.type == 1);
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵadvance"](1);
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵproperty"]("ngIf", ctx_r1.ngBox.current.type == 2);
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵadvance"](1);
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵproperty"]("ngIf", ctx_r1.ngBox.current.type == 3);
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵadvance"](1);
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵproperty"]("ngIf", ctx_r1.ngBox.current.type == 4);
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵadvance"](1);
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵproperty"]("hidden", ctx_r1.ngBox.loading);
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵadvance"](3);
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵproperty"]("ngIf", ctx_r1.ngBox.current.title);
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵadvance"](1);
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵproperty"]("ngIf", ctx_r1.getHasGroup());
} }
class NgBoxComponent {
    constructor(ngBox) {
        this.ngBox = ngBox;
        this.showMore = new _angular_core__WEBPACK_IMPORTED_MODULE_0__["EventEmitter"]();
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
}
NgBoxComponent.ɵfac = function NgBoxComponent_Factory(t) { return new (t || NgBoxComponent)(_angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵdirectiveInject"](_ngbox_service__WEBPACK_IMPORTED_MODULE_1__["NgBoxService"])); };
NgBoxComponent.ɵcmp = _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵdefineComponent"]({ type: NgBoxComponent, selectors: [["my-ngbox"], ["ngbox"]], viewQuery: function NgBoxComponent_Query(rf, ctx) { if (rf & 1) {
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵviewQuery"](_c0, true);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵviewQuery"](_c1, true);
    } if (rf & 2) {
        var _t;
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵqueryRefresh"](_t = _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵloadQuery"]()) && (ctx.elementView = _t.first);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵqueryRefresh"](_t = _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵloadQuery"]()) && (ctx.elementButtons = _t.first);
    } }, hostBindings: function NgBoxComponent_HostBindings(rf, ctx) { if (rf & 1) {
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵlistener"]("resize", function NgBoxComponent_resize_HostBindingHandler($event) { return ctx.resize($event); }, false, _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵresolveWindow"])("keydown", function NgBoxComponent_keydown_HostBindingHandler($event) { return ctx.checkKeyPress($event); }, false, _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵresolveWindow"]);
    } }, inputs: { data: "data" }, outputs: { showMore: "showMore" }, decls: 2, vars: 2, consts: [["id", "ngBoxLoading", 4, "ngIf"], ["id", "ngBoxWrapper", 3, "ngStyle", "click", 4, "ngIf"], ["id", "ngBoxLoading"], ["src", "data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNv\nZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9Im5vIj8+PHN2ZyB4bWxuczpzdmc9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxucz0iaHR0cD\novL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB2ZXJzaW9uPSIxLjAiIHdpZHRo\nPSIxNjBweCIgaGVpZ2h0PSIyMHB4IiB2aWV3Qm94PSIwIDAgMTI4IDE2IiB4bWw6c3BhY2U9InByZXNlcnZlIj48c2NyaXB0IHR5cGU9InRleHQvZW\nNtYXNjcmlwdCIgeGxpbms6aHJlZj0iLy9wcmVsb2FkZXJzLm5ldC9qc2NyaXB0cy9zbWlsLnVzZXIuanMiLz48cGF0aCBmaWxsPSIjZmZmZmZmIiBm\naWxsLW9wYWNpdHk9IjAuNDE5NjA3ODQzMTM3MjUiIGQ9Ik02LjQsNC44QTMuMiwzLjIsMCwxLDEsMy4yLDgsMy4yLDMuMiwwLDAsMSw2LjQsNC44Wm\n0xMi44LDBBMy4yLDMuMiwwLDEsMSwxNiw4LDMuMiwzLjIsMCwwLDEsMTkuMiw0LjhaTTMyLDQuOEEzLjIsMy4yLDAsMSwxLDI4LjgsOCwzLjIsMy4y\nLDAsMCwxLDMyLDQuOFptMTIuOCwwQTMuMiwzLjIsMCwxLDEsNDEuNiw4LDMuMiwzLjIsMCwwLDEsNDQuOCw0LjhabTEyLjgsMEEzLjIsMy4yLDAsMS\nwxLDU0LjQsOCwzLjIsMy4yLDAsMCwxLDU3LjYsNC44Wm0xMi44LDBBMy4yLDMuMiwwLDEsMSw2Ny4yLDgsMy4yLDMuMiwwLDAsMSw3MC40LDQuOFpt\nMTIuOCwwQTMuMiwzLjIsMCwxLDEsODAsOCwzLjIsMy4yLDAsMCwxLDgzLjIsNC44Wk05Niw0LjhBMy4yLDMuMiwwLDEsMSw5Mi44LDgsMy4yLDMuMi\nwwLDAsMSw5Niw0LjhabTEyLjgsMEEzLjIsMy4yLDAsMSwxLDEwNS42LDgsMy4yLDMuMiwwLDAsMSwxMDguOCw0LjhabTEyLjgsMEEzLjIsMy4yLDAs\nMSwxLDExOC40LDgsMy4yLDMuMiwwLDAsMSwxMjEuNiw0LjhaIi8+PGc+PHBhdGggZmlsbD0iI2ZmZmZmZiIgZmlsbC1vcGFjaXR5PSIxIiBkPSJNLT\nQyLjcsMy44NEE0LjE2LDQuMTYsMCwwLDEtMzguNTQsOGE0LjE2LDQuMTYsMCwwLDEtNC4xNiw0LjE2QTQuMTYsNC4xNiwwLDAsMS00Ni44Niw4LDQu\nMTYsNC4xNiwwLDAsMS00Mi43LDMuODRabTEyLjgtLjY0QTQuOCw0LjgsMCwwLDEtMjUuMSw4YTQuOCw0LjgsMCwwLDEtNC44LDQuOEE0LjgsNC44LD\nAsMCwxLTM0LjcsOCw0LjgsNC44LDAsMCwxLTI5LjksMy4yWm0xMi44LS42NEE1LjQ0LDUuNDQsMCwwLDEtMTEuNjYsOGE1LjQ0LDUuNDQsMCwwLDEt\nNS40NCw1LjQ0QTUuNDQsNS40NCwwLDAsMS0yMi41NCw4LDUuNDQsNS40NCwwLDAsMS0xNy4xLDIuNTZaIi8+PGFuaW1hdGVUcmFuc2Zvcm0gYXR0cm\nlidXRlTmFtZT0idHJhbnNmb3JtIiB0eXBlPSJ0cmFuc2xhdGUiIHZhbHVlcz0iMjMgMDszNiAwOzQ5IDA7NjIgMDs3NC41IDA7ODcuNSAwOzEwMCAw\nOzExMyAwOzEyNS41IDA7MTM4LjUgMDsxNTEuNSAwOzE2NC41IDA7MTc4IDAiIGNhbGNNb2RlPSJkaXNjcmV0ZSIgZHVyPSI3ODBtcyIgcmVwZWF0Q2\n91bnQ9ImluZGVmaW5pdGUiLz48L2c+PC9zdmc+Cg=="], ["id", "ngBoxWrapper", 3, "ngStyle", "click"], ["id", "ngBoxContent"], ["class", "left", "src", "data:image/svg+xml;base64,PD94bWwgdmVyc2lvb\nj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz4NCjwhLS0gR2VuZXJhdG9yOiBBZG9iZSBJbGx1c3RyYXRvciAxNS4xLjAsIFNWRyBFeHBvcnQgUGx1Zy1JbiAuIFNWRyB\nWZXJzaW9uOiA2LjAwIEJ1aWxkIDApICAtLT4NCjwhRE9DVFlQRSBzdmcgUFVCTElDICItLy9XM0MvL0RURCBTVkcgMS4xLy9FTiIgImh0dHA6Ly93d3cudzMub3JnL\n0dyYXBoaWNzL1NWRy8xLjEvRFREL3N2ZzExLmR0ZCI+DQo8c3ZnIHZlcnNpb249IjEuMSIgaWQ9IkxheWVyXzEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDA\nwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHg9IjBweCIgeT0iMHB4Ig0KCSB3aWR0aD0iNzBweCIgaGVpZ2h0PSIxMDBwe\nCIgdmlld0JveD0iMCAwIDcwIDEwMCIgZW5hYmxlLWJhY2tncm91bmQ9Im5ldyAwIDAgNzAgMTAwIiB4bWw6c3BhY2U9InByZXNlcnZlIj4NCjxwb2x5Z29uIGZpbGw\n9IiNGRkZGRkYiIHN0cm9rZT0iIzZCNkI2QiIgc3Ryb2tlLW1pdGVybGltaXQ9IjEwIiBwb2ludHM9IjQ1LjYsOTguNTI0IDE0LjU0NCw1MCA0NS42LDEuNDc2IDQ4L\njgwMSwzLjUyNCAxOS4wNTYsNTAgDQoJNDguODAxLDk2LjQ3NiAiLz4NCjwvc3ZnPg0K", 3, "click", 4, "ngIf"], ["class", "right", "src", "data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0i\nMS4wIiBlbmNvZGluZz0idXRmLTgiPz4NCjwhLS0gR2VuZXJhdG9yOiBBZG9iZSBJbGx1c3RyYXRvciAxNS4xLjAsIFNWRyBFeHBvcnQgUGx1Zy1JbiAuIFNWRyBWZX\nJzaW9uOiA2LjAwIEJ1aWxkIDApICAtLT4NCjwhRE9DVFlQRSBzdmcgUFVCTElDICItLy9XM0MvL0RURCBTVkcgMS4xLy9FTiIgImh0dHA6Ly93d3cudzMub3JnL0dy\nYXBoaWNzL1NWRy8xLjEvRFREL3N2ZzExLmR0ZCI+DQo8c3ZnIHZlcnNpb249IjEuMSIgaWQ9IkxheWVyXzEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3\nN2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHg9IjBweCIgeT0iMHB4Ig0KCSB3aWR0aD0iNzBweCIgaGVpZ2h0PSIxMDBweCIg\ndmlld0JveD0iMCAwIDcwIDEwMCIgZW5hYmxlLWJhY2tncm91bmQ9Im5ldyAwIDAgNzAgMTAwIiB4bWw6c3BhY2U9InByZXNlcnZlIj4NCjxwb2x5Z29uIGZpbGw9Ii\nNGRkZGRkYiIHN0cm9rZT0iIzZCNkI2QiIgc3Ryb2tlLW1pdGVybGltaXQ9IjEwIiBwb2ludHM9IjE3Ljc0Niw5OC41MjQgNDguODAxLDUwIDE3Ljc0NiwxLjQ3NiAx\nNC41NDUsMy41MjQgDQoJNDQuMjg5LDUwIDE0LjU0NSw5Ni40NzYgIi8+DQo8L3N2Zz4NCg==", 3, "click", 4, "ngIf"], ["alt", "", 3, "src", "hidden", "load", "click", 4, "ngIf"], ["frameborder", "0", "allowfullscreen", "", 3, "src", "width", "height", 4, "ngIf"], ["frameborder", "0", "webkitallowfullscreen", "", "mozallowfullscreen", "", "allowfullscreen", "", 3, "src", "width", "height", 4, "ngIf"], ["id", "buttons", 3, "hidden"], ["ngBoxButtons", ""], ["class", "title", 4, "ngIf"], ["class", "pages", 4, "ngIf"], ["id", "closeButton", "src", "data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZG\nluZz0idXRmLTgiPz4NCjwhLS0gR2VuZXJhdG9yOiBBZG9iZSBJbGx1c3RyYXRvciAxNS4xLjAsIFNWRyBFeHBvcnQgUGx1Zy1JbiAuIFNWRyBWZXJzaW9uOiA2LjAw\nIEJ1aWxkIDApICAtLT4NCjwhRE9DVFlQRSBzdmcgUFVCTElDICItLy9XM0MvL0RURCBTVkcgMS4xLy9FTiIgImh0dHA6Ly93d3cudzMub3JnL0dyYXBoaWNzL1NWRy\n8xLjEvRFREL3N2ZzExLmR0ZCI+DQo8c3ZnIHZlcnNpb249IjEuMSIgaWQ9IkxheWVyXzEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6\neGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHg9IjBweCIgeT0iMHB4Ig0KCSB3aWR0aD0iMzBweCIgaGVpZ2h0PSIzMHB4IiB2aWV3Qm94PSIwID\nAgMzAgMzAiIGVuYWJsZS1iYWNrZ3JvdW5kPSJuZXcgMCAwIDMwIDMwIiB4bWw6c3BhY2U9InByZXNlcnZlIj4NCjxwb2x5Z29uIGZpbGw9IiNGRkZGRkYiIHN0cm9r\nZT0iIzZCNkI2QiIgc3Ryb2tlLW1pdGVybGltaXQ9IjEwIiBwb2ludHM9IjI4LjUsMi44NCAyNS40NjMsMS41IDE1LDEyLjc0OSA0LjUzOSwxLjUgMS41LDIuODQgDQ\noJMTIuODExLDE1IDEuNSwyNy4xNiA0LjUzOSwyOC41IDE1LDE3LjI1MSAyNS40NjMsMjguNSAyOC41LDI3LjE2IDE3LjE4OSwxNSAiLz4NCjwvc3ZnPg0K", "alt", "", 3, "click"], ["src", "data:image/svg+xml;base64,PD94bWwgdmVyc2lvb\nj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz4NCjwhLS0gR2VuZXJhdG9yOiBBZG9iZSBJbGx1c3RyYXRvciAxNS4xLjAsIFNWRyBFeHBvcnQgUGx1Zy1JbiAuIFNWRyB\nWZXJzaW9uOiA2LjAwIEJ1aWxkIDApICAtLT4NCjwhRE9DVFlQRSBzdmcgUFVCTElDICItLy9XM0MvL0RURCBTVkcgMS4xLy9FTiIgImh0dHA6Ly93d3cudzMub3JnL\n0dyYXBoaWNzL1NWRy8xLjEvRFREL3N2ZzExLmR0ZCI+DQo8c3ZnIHZlcnNpb249IjEuMSIgaWQ9IkxheWVyXzEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDA\nwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHg9IjBweCIgeT0iMHB4Ig0KCSB3aWR0aD0iNzBweCIgaGVpZ2h0PSIxMDBwe\nCIgdmlld0JveD0iMCAwIDcwIDEwMCIgZW5hYmxlLWJhY2tncm91bmQ9Im5ldyAwIDAgNzAgMTAwIiB4bWw6c3BhY2U9InByZXNlcnZlIj4NCjxwb2x5Z29uIGZpbGw\n9IiNGRkZGRkYiIHN0cm9rZT0iIzZCNkI2QiIgc3Ryb2tlLW1pdGVybGltaXQ9IjEwIiBwb2ludHM9IjQ1LjYsOTguNTI0IDE0LjU0NCw1MCA0NS42LDEuNDc2IDQ4L\njgwMSwzLjUyNCAxOS4wNTYsNTAgDQoJNDguODAxLDk2LjQ3NiAiLz4NCjwvc3ZnPg0K", 1, "left", 3, "click"], ["src", "data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0i\nMS4wIiBlbmNvZGluZz0idXRmLTgiPz4NCjwhLS0gR2VuZXJhdG9yOiBBZG9iZSBJbGx1c3RyYXRvciAxNS4xLjAsIFNWRyBFeHBvcnQgUGx1Zy1JbiAuIFNWRyBWZX\nJzaW9uOiA2LjAwIEJ1aWxkIDApICAtLT4NCjwhRE9DVFlQRSBzdmcgUFVCTElDICItLy9XM0MvL0RURCBTVkcgMS4xLy9FTiIgImh0dHA6Ly93d3cudzMub3JnL0dy\nYXBoaWNzL1NWRy8xLjEvRFREL3N2ZzExLmR0ZCI+DQo8c3ZnIHZlcnNpb249IjEuMSIgaWQ9IkxheWVyXzEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3\nN2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHg9IjBweCIgeT0iMHB4Ig0KCSB3aWR0aD0iNzBweCIgaGVpZ2h0PSIxMDBweCIg\ndmlld0JveD0iMCAwIDcwIDEwMCIgZW5hYmxlLWJhY2tncm91bmQ9Im5ldyAwIDAgNzAgMTAwIiB4bWw6c3BhY2U9InByZXNlcnZlIj4NCjxwb2x5Z29uIGZpbGw9Ii\nNGRkZGRkYiIHN0cm9rZT0iIzZCNkI2QiIgc3Ryb2tlLW1pdGVybGltaXQ9IjEwIiBwb2ludHM9IjE3Ljc0Niw5OC41MjQgNDguODAxLDUwIDE3Ljc0NiwxLjQ3NiAx\nNC41NDUsMy41MjQgDQoJNDQuMjg5LDUwIDE0LjU0NSw5Ni40NzYgIi8+DQo8L3N2Zz4NCg==", 1, "right", 3, "click"], ["alt", "", 3, "src", "hidden", "load", "click"], ["ngBoxContent", ""], ["frameborder", "0", "allowfullscreen", "", 3, "src", "width", "height"], ["frameborder", "0", "webkitallowfullscreen", "", "mozallowfullscreen", "", "allowfullscreen", "", 3, "src", "width", "height"], [1, "title"], [1, "pages"]], template: function NgBoxComponent_Template(rf, ctx) { if (rf & 1) {
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵtemplate"](0, NgBoxComponent_div_0_Template, 2, 0, "div", 0);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵtemplate"](1, NgBoxComponent_div_1_Template, 14, 12, "div", 1);
    } if (rf & 2) {
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵproperty"]("ngIf", ctx.ngBox.loading);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵadvance"](1);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵproperty"]("ngIf", ctx.ngBox.open);
    } }, directives: [_angular_common__WEBPACK_IMPORTED_MODULE_2__["NgIf"], _angular_common__WEBPACK_IMPORTED_MODULE_2__["NgStyle"]], styles: ["#ngBoxLoading[_ngcontent-%COMP%]{\n            text-align: center;\n            z-index: 10001;\n            width: 100%;\n            height: 100%;\n            color: white;\n            position: fixed;\n            top: 46%;\n            font-size: 20px;\n        }\n        #ngBoxWrapper[_ngcontent-%COMP%] {\n            background-color: rgba(0, 0, 0, 0.9);\n            position: fixed;\n            top: 0px;\n            left: 0px;\n            text-align: center;\n            z-index: 10000;\n            width: 100%;\n            height: 100%;\n        }\n\n        #ngBoxWrapper[_ngcontent-%COMP%]   #ngBoxContent[_ngcontent-%COMP%]   img[_ngcontent-%COMP%] {\n            -webkit-border-radius: 4px;\n            -moz-border-radius: 4px;\n            border-radius: 4px;\n        }\n\n        #ngBoxContent[_ngcontent-%COMP%] {\n            display: block;\n        }\n\n        button[_ngcontent-%COMP%] {\n            font-size: 12px;\n        }\n\n        iframe[_ngcontent-%COMP%] {\n            max-width: 100%;\n            max-height: 100%;\n        }\n        #buttons[_ngcontent-%COMP%]{\n            position: relative;\n            margin: 5px auto;\n            text-align: right;\n        }\n        #buttons[_ngcontent-%COMP%]   p[_ngcontent-%COMP%]{\n            float: left;\n            color: white;\n            text-align: left;\n            margin: 0 50px 0 0;\n            font-size: 12px;\n            font-family: sans-serif;\n        }\n        #buttons[_ngcontent-%COMP%]   span.title[_ngcontent-%COMP%]{\n            display: block;\n            height: 18px;\n            overflow: hidden;\n        }\n        #closeButton[_ngcontent-%COMP%]{\n            position: absolute;\n            top: 0px;\n            right: 0px;\n            cursor: pointer;\n        }\n        .left[_ngcontent-%COMP%]{\n            position: fixed;\n            left: -5px;\n            margin-top: -42px;\n            cursor: pointer;\n            top: 50%;\n        }\n        .right[_ngcontent-%COMP%]{\n            position: fixed;\n            right: -10px;\n            margin-top: -42px;\n            cursor: pointer;\n            top: 50%;\n        }"] });
/*@__PURE__*/ (function () { _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵsetClassMetadata"](NgBoxComponent, [{
        type: _angular_core__WEBPACK_IMPORTED_MODULE_0__["Component"],
        args: [{
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
                styles: [`
        #ngBoxLoading{
            text-align: center;
            z-index: 10001;
            width: 100%;
            height: 100%;
            color: white;
            position: fixed;
            top: 46%;
            font-size: 20px;
        }
        #ngBoxWrapper {
            background-color: rgba(0, 0, 0, 0.9);
            position: fixed;
            top: 0px;
            left: 0px;
            text-align: center;
            z-index: 10000;
            width: 100%;
            height: 100%;
        }

        #ngBoxWrapper #ngBoxContent img {
            -webkit-border-radius: 4px;
            -moz-border-radius: 4px;
            border-radius: 4px;
        }

        #ngBoxContent {
            display: block;
        }

        button {
            font-size: 12px;
        }

        iframe {
            max-width: 100%;
            max-height: 100%;
        }
        #buttons{
            position: relative;
            margin: 5px auto;
            text-align: right;
        }
        #buttons p{
            float: left;
            color: white;
            text-align: left;
            margin: 0 50px 0 0;
            font-size: 12px;
            font-family: sans-serif;
        }
        #buttons span.title{
            display: block;
            height: 18px;
            overflow: hidden;
        }
        #closeButton{
            position: absolute;
            top: 0px;
            right: 0px;
            cursor: pointer;
        }
        .left{
            position: fixed;
            left: -5px;
            margin-top: -42px;
            cursor: pointer;
            top: 50%;
        }
        .right{
            position: fixed;
            right: -10px;
            margin-top: -42px;
            cursor: pointer;
            top: 50%;
        }
    `]
            }]
    }], function () { return [{ type: _ngbox_service__WEBPACK_IMPORTED_MODULE_1__["NgBoxService"] }]; }, { data: [{
            type: _angular_core__WEBPACK_IMPORTED_MODULE_0__["Input"]
        }], showMore: [{
            type: _angular_core__WEBPACK_IMPORTED_MODULE_0__["Output"]
        }], elementView: [{
            type: _angular_core__WEBPACK_IMPORTED_MODULE_0__["ViewChild"],
            args: ['ngBoxContent', {}]
        }], elementButtons: [{
            type: _angular_core__WEBPACK_IMPORTED_MODULE_0__["ViewChild"],
            args: ['ngBoxButtons', {}]
        }], resize: [{
            type: _angular_core__WEBPACK_IMPORTED_MODULE_0__["HostListener"],
            args: ['window:resize', ['$event']]
        }], checkKeyPress: [{
            type: _angular_core__WEBPACK_IMPORTED_MODULE_0__["HostListener"],
            args: ['window:keydown', ['$event']]
        }] }); })();


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
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @angular/core */ "./node_modules/@angular/core/__ivy_ngcc__/fesm2015/core.js");
/* harmony import */ var _angular_platform_browser__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @angular/platform-browser */ "./node_modules/@angular/platform-browser/__ivy_ngcc__/fesm2015/platform-browser.js");
/* harmony import */ var _ngbox_service__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./ngbox.service */ "./src/app/ngbox/ngbox.service.ts");






class NgBoxDirective {
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
}
NgBoxDirective.ɵfac = function NgBoxDirective_Factory(t) { return new (t || NgBoxDirective)(_angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵdirectiveInject"](_ngbox_service__WEBPACK_IMPORTED_MODULE_2__["NgBoxService"]), _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵdirectiveInject"](_angular_platform_browser__WEBPACK_IMPORTED_MODULE_1__["DomSanitizer"])); };
NgBoxDirective.ɵdir = _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵdefineDirective"]({ type: NgBoxDirective, selectors: [["", "myNgBox", ""], ["", "ng-box", ""]], hostBindings: function NgBoxDirective_HostBindings(rf, ctx) { if (rf & 1) {
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵlistener"]("click", function NgBoxDirective_click_HostBindingHandler($event) { return ctx.onClick($event); });
    } }, inputs: { src: "src", href: "href", title: "title", width: "width", height: "height", group: "group", cache: "cache", image: "image" } });
/*@__PURE__*/ (function () { _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵsetClassMetadata"](NgBoxDirective, [{
        type: _angular_core__WEBPACK_IMPORTED_MODULE_0__["Directive"],
        args: [{
                selector: '[myNgBox],[ng-box]'
            }]
    }], function () { return [{ type: _ngbox_service__WEBPACK_IMPORTED_MODULE_2__["NgBoxService"] }, { type: _angular_platform_browser__WEBPACK_IMPORTED_MODULE_1__["DomSanitizer"] }]; }, { src: [{
            type: _angular_core__WEBPACK_IMPORTED_MODULE_0__["Input"]
        }], href: [{
            type: _angular_core__WEBPACK_IMPORTED_MODULE_0__["Input"]
        }], title: [{
            type: _angular_core__WEBPACK_IMPORTED_MODULE_0__["Input"]
        }], width: [{
            type: _angular_core__WEBPACK_IMPORTED_MODULE_0__["Input"]
        }], height: [{
            type: _angular_core__WEBPACK_IMPORTED_MODULE_0__["Input"]
        }], group: [{
            type: _angular_core__WEBPACK_IMPORTED_MODULE_0__["Input"]
        }], cache: [{
            type: _angular_core__WEBPACK_IMPORTED_MODULE_0__["Input"]
        }], image: [{
            type: _angular_core__WEBPACK_IMPORTED_MODULE_0__["Input"]
        }], onClick: [{
            type: _angular_core__WEBPACK_IMPORTED_MODULE_0__["HostListener"],
            args: ['click', ['$event']]
        }] }); })();


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
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @angular/core */ "./node_modules/@angular/core/__ivy_ngcc__/fesm2015/core.js");


class NgBoxService {
    constructor() {
        this.id = 0;
        this.loading = false;
        this.open = false;
        this.images = [];
    }
}
NgBoxService.ɵfac = function NgBoxService_Factory(t) { return new (t || NgBoxService)(); };
NgBoxService.ɵprov = _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵdefineInjectable"]({ token: NgBoxService, factory: NgBoxService.ɵfac });
/*@__PURE__*/ (function () { _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵsetClassMetadata"](NgBoxService, [{
        type: _angular_core__WEBPACK_IMPORTED_MODULE_0__["Injectable"]
    }], function () { return []; }, null); })();


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
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @angular/core */ "./node_modules/@angular/core/__ivy_ngcc__/fesm2015/core.js");
/* harmony import */ var _angular_router__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @angular/router */ "./node_modules/@angular/router/__ivy_ngcc__/fesm2015/router.js");
/* harmony import */ var _services_page_data_service__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../services/page_data.service */ "./src/app/services/page_data.service.ts");
/* harmony import */ var _gallery_gallery_toolbar_gallery_toolbar_component__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../../gallery/gallery-toolbar/gallery-toolbar.component */ "./src/app/gallery/gallery-toolbar/gallery-toolbar.component.ts");
/* harmony import */ var _gallery_gallery_info_gallery_info_component__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ../../gallery/gallery-info/gallery-info.component */ "./src/app/gallery/gallery-info/gallery-info.component.ts");
/* harmony import */ var _gallery_gallery_list_gallery_list_component__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! ../../gallery/gallery-list/gallery-list.component */ "./src/app/gallery/gallery-list/gallery-list.component.ts");
/* harmony import */ var _image_image_list_image_list_component__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! ../../image/image-list/image-list.component */ "./src/app/image/image-list/image-list.component.ts");










class GalleryPageComponent {
    constructor(route, page_data_service) {
        this.route = route;
        this.page_data_service = page_data_service;
    }
    ngOnInit() {
        this.route.params.subscribe(params => {
            this.page_data_service.GetGalleryPageData(params['id']);
        });
    }
}
GalleryPageComponent.ɵfac = function GalleryPageComponent_Factory(t) { return new (t || GalleryPageComponent)(_angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵdirectiveInject"](_angular_router__WEBPACK_IMPORTED_MODULE_1__["ActivatedRoute"]), _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵdirectiveInject"](_services_page_data_service__WEBPACK_IMPORTED_MODULE_2__["PageDataService"])); };
GalleryPageComponent.ɵcmp = _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵdefineComponent"]({ type: GalleryPageComponent, selectors: [["gallery-page"]], decls: 4, vars: 0, template: function GalleryPageComponent_Template(rf, ctx) { if (rf & 1) {
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelement"](0, "gallery-toolbar");
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelement"](1, "gallery-info");
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelement"](2, "gallery-list");
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelement"](3, "image-list");
    } }, directives: [_gallery_gallery_toolbar_gallery_toolbar_component__WEBPACK_IMPORTED_MODULE_3__["GalleryToolbarComponent"], _gallery_gallery_info_gallery_info_component__WEBPACK_IMPORTED_MODULE_4__["GalleryInfoComponent"], _gallery_gallery_list_gallery_list_component__WEBPACK_IMPORTED_MODULE_5__["GalleryListComponent"], _image_image_list_image_list_component__WEBPACK_IMPORTED_MODULE_6__["ImageListComponent"]], styles: ["\n/*# sourceMappingURL=data:application/json;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbXSwibmFtZXMiOltdLCJtYXBwaW5ncyI6IiIsImZpbGUiOiJzcmMvYXBwL3BhZ2VzL2dhbGxlcnktcGFnZS9nYWxsZXJ5LXBhZ2UuY29tcG9uZW50LmNzcyJ9 */"] });
/*@__PURE__*/ (function () { _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵsetClassMetadata"](GalleryPageComponent, [{
        type: _angular_core__WEBPACK_IMPORTED_MODULE_0__["Component"],
        args: [{
                selector: 'gallery-page',
                templateUrl: './gallery-page.component.html',
                styleUrls: ['./gallery-page.component.css']
            }]
    }], function () { return [{ type: _angular_router__WEBPACK_IMPORTED_MODULE_1__["ActivatedRoute"] }, { type: _services_page_data_service__WEBPACK_IMPORTED_MODULE_2__["PageDataService"] }]; }, null); })();


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
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @angular/core */ "./node_modules/@angular/core/__ivy_ngcc__/fesm2015/core.js");
/* harmony import */ var _services_page_data_service__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../../services/page_data.service */ "./src/app/services/page_data.service.ts");
/* harmony import */ var _home_home_toolbar_home_toolbar_component__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../home/home-toolbar/home-toolbar.component */ "./src/app/home/home-toolbar/home-toolbar.component.ts");
/* harmony import */ var _gallery_gallery_list_gallery_list_component__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../../gallery/gallery-list/gallery-list.component */ "./src/app/gallery/gallery-list/gallery-list.component.ts");






class HomePageComponent {
    constructor(page_data_service) {
        this.page_data_service = page_data_service;
    }
    ngOnInit() {
        this.page_data_service.GetHomePageData();
    }
}
HomePageComponent.ɵfac = function HomePageComponent_Factory(t) { return new (t || HomePageComponent)(_angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵdirectiveInject"](_services_page_data_service__WEBPACK_IMPORTED_MODULE_1__["PageDataService"])); };
HomePageComponent.ɵcmp = _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵdefineComponent"]({ type: HomePageComponent, selectors: [["moa"]], decls: 2, vars: 0, template: function HomePageComponent_Template(rf, ctx) { if (rf & 1) {
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelement"](0, "home-toolbar");
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelement"](1, "gallery-list");
    } }, directives: [_home_home_toolbar_home_toolbar_component__WEBPACK_IMPORTED_MODULE_2__["HomeToolbarComponent"], _gallery_gallery_list_gallery_list_component__WEBPACK_IMPORTED_MODULE_3__["GalleryListComponent"]], styles: ["\n/*# sourceMappingURL=data:application/json;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbXSwibmFtZXMiOltdLCJtYXBwaW5ncyI6IiIsImZpbGUiOiJzcmMvYXBwL3BhZ2VzL2hvbWUtcGFnZS9ob21lLXBhZ2UuY29tcG9uZW50LmNzcyJ9 */"] });
/*@__PURE__*/ (function () { _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵsetClassMetadata"](HomePageComponent, [{
        type: _angular_core__WEBPACK_IMPORTED_MODULE_0__["Component"],
        args: [{
                selector: 'moa',
                templateUrl: './home-page.component.html',
                styleUrls: ['./home-page.component.css']
            }]
    }], function () { return [{ type: _services_page_data_service__WEBPACK_IMPORTED_MODULE_1__["PageDataService"] }]; }, null); })();


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
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @angular/core */ "./node_modules/@angular/core/__ivy_ngcc__/fesm2015/core.js");
/* harmony import */ var _angular_router__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @angular/router */ "./node_modules/@angular/router/__ivy_ngcc__/fesm2015/router.js");
/* harmony import */ var _services_page_data_service__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../services/page_data.service */ "./src/app/services/page_data.service.ts");
/* harmony import */ var _image_image_toolbar_image_toolbar_component__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../../image/image-toolbar/image-toolbar.component */ "./src/app/image/image-toolbar/image-toolbar.component.ts");
/* harmony import */ var _image_image_info_image_info_component__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ../../image/image-info/image-info.component */ "./src/app/image/image-info/image-info.component.ts");








class ImagePageComponent {
    constructor(route, page_data_service) {
        this.route = route;
        this.page_data_service = page_data_service;
    }
    ngOnInit() {
        this.route.params.subscribe(params => {
            this.page_data_service.GetImagePageData(params['image_id'], params['gallery_id']);
        });
    }
}
ImagePageComponent.ɵfac = function ImagePageComponent_Factory(t) { return new (t || ImagePageComponent)(_angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵdirectiveInject"](_angular_router__WEBPACK_IMPORTED_MODULE_1__["ActivatedRoute"]), _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵdirectiveInject"](_services_page_data_service__WEBPACK_IMPORTED_MODULE_2__["PageDataService"])); };
ImagePageComponent.ɵcmp = _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵdefineComponent"]({ type: ImagePageComponent, selectors: [["image-page"]], decls: 2, vars: 0, template: function ImagePageComponent_Template(rf, ctx) { if (rf & 1) {
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelement"](0, "image-toolbar");
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelement"](1, "image-info");
    } }, directives: [_image_image_toolbar_image_toolbar_component__WEBPACK_IMPORTED_MODULE_3__["ImageToolbarComponent"], _image_image_info_image_info_component__WEBPACK_IMPORTED_MODULE_4__["ImageInfoComponent"]], styles: ["\n/*# sourceMappingURL=data:application/json;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbXSwibmFtZXMiOltdLCJtYXBwaW5ncyI6IiIsImZpbGUiOiJzcmMvYXBwL3BhZ2VzL2ltYWdlLXBhZ2UvaW1hZ2UtcGFnZS5jb21wb25lbnQuY3NzIn0= */"] });
/*@__PURE__*/ (function () { _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵsetClassMetadata"](ImagePageComponent, [{
        type: _angular_core__WEBPACK_IMPORTED_MODULE_0__["Component"],
        args: [{
                selector: 'image-page',
                templateUrl: './image-page.component.html',
                styleUrls: ['./image-page.component.css']
            }]
    }], function () { return [{ type: _angular_router__WEBPACK_IMPORTED_MODULE_1__["ActivatedRoute"] }, { type: _services_page_data_service__WEBPACK_IMPORTED_MODULE_2__["PageDataService"] }]; }, null); })();


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
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @angular/core */ "./node_modules/@angular/core/__ivy_ngcc__/fesm2015/core.js");
/* harmony import */ var rxjs_Subject__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! rxjs/Subject */ "./node_modules/rxjs-compat/_esm2015/Subject.js");



class ButtonClickService {
    constructor() {
        this.notify = new rxjs_Subject__WEBPACK_IMPORTED_MODULE_1__["Subject"]();
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
}
ButtonClickService.ɵfac = function ButtonClickService_Factory(t) { return new (t || ButtonClickService)(); };
ButtonClickService.ɵprov = _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵdefineInjectable"]({ token: ButtonClickService, factory: ButtonClickService.ɵfac });
/*@__PURE__*/ (function () { _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵsetClassMetadata"](ButtonClickService, [{
        type: _angular_core__WEBPACK_IMPORTED_MODULE_0__["Injectable"]
    }], function () { return []; }, null); })();


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
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @angular/core */ "./node_modules/@angular/core/__ivy_ngcc__/fesm2015/core.js");
/* harmony import */ var _angular_common_http__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @angular/common/http */ "./node_modules/@angular/common/__ivy_ngcc__/fesm2015/http.js");
/* harmony import */ var rxjs_BehaviorSubject__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! rxjs/BehaviorSubject */ "./node_modules/rxjs-compat/_esm2015/BehaviorSubject.js");
/* harmony import */ var rxjs_add_operator_map__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! rxjs/add/operator/map */ "./node_modules/rxjs-compat/_esm2015/add/operator/map.js");
/* harmony import */ var rxjs_add_operator_filter__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! rxjs/add/operator/filter */ "./node_modules/rxjs-compat/_esm2015/add/operator/filter.js");







class DataService {
    constructor(http) {
        this.http = http;
        this.data = new rxjs_BehaviorSubject__WEBPACK_IMPORTED_MODULE_2__["BehaviorSubject"]([]);
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
}
DataService.ɵfac = function DataService_Factory(t) { return new (t || DataService)(_angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵinject"](_angular_common_http__WEBPACK_IMPORTED_MODULE_1__["HttpClient"])); };
DataService.ɵprov = _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵdefineInjectable"]({ token: DataService, factory: DataService.ɵfac });
/*@__PURE__*/ (function () { _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵsetClassMetadata"](DataService, [{
        type: _angular_core__WEBPACK_IMPORTED_MODULE_0__["Injectable"]
    }], function () { return [{ type: _angular_common_http__WEBPACK_IMPORTED_MODULE_1__["HttpClient"] }]; }, null); })();


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
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @angular/core */ "./node_modules/@angular/core/__ivy_ngcc__/fesm2015/core.js");
/* harmony import */ var _data_service__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./data.service */ "./src/app/services/data.service.ts");
/* harmony import */ var _angular_common_http__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @angular/common/http */ "./node_modules/@angular/common/__ivy_ngcc__/fesm2015/http.js");
/* harmony import */ var rxjs_Subject__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! rxjs/Subject */ "./node_modules/rxjs-compat/_esm2015/Subject.js");







class GalleryService {
    constructor(dataService, http) {
        this.dataService = dataService;
        this.http = http;
        this.api_url = '/api/gallery/';
    }
    SubmitGallery(data) {
        let url = this.api_url + data.id;
        let subject = new rxjs_Subject__WEBPACK_IMPORTED_MODULE_3__["Subject"]();
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
        let subject = new rxjs_Subject__WEBPACK_IMPORTED_MODULE_3__["Subject"]();
        this.http.delete(url)
            .subscribe(data => {
            subject.next({ success: data['success'], message: data['message'] });
        });
        return subject.asObservable();
    }
    MoveImage(gallery_id, image_id, position, targetImageId) {
        let url = this.api_url + gallery_id + '/' + image_id + '/move/' + position + '/' + targetImageId;
        let subject = new rxjs_Subject__WEBPACK_IMPORTED_MODULE_3__["Subject"]();
        this.http.post(url, null)
            .subscribe(data => {
            subject.next({ success: data['success'], message: data['images'] });
            this.dataService.setPageData({ images: data['images'] });
        });
        return subject.asObservable();
    }
}
GalleryService.ɵfac = function GalleryService_Factory(t) { return new (t || GalleryService)(_angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵinject"](_data_service__WEBPACK_IMPORTED_MODULE_1__["DataService"]), _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵinject"](_angular_common_http__WEBPACK_IMPORTED_MODULE_2__["HttpClient"])); };
GalleryService.ɵprov = _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵdefineInjectable"]({ token: GalleryService, factory: GalleryService.ɵfac });
/*@__PURE__*/ (function () { _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵsetClassMetadata"](GalleryService, [{
        type: _angular_core__WEBPACK_IMPORTED_MODULE_0__["Injectable"]
    }], function () { return [{ type: _data_service__WEBPACK_IMPORTED_MODULE_1__["DataService"] }, { type: _angular_common_http__WEBPACK_IMPORTED_MODULE_2__["HttpClient"] }]; }, null); })();


/***/ }),

/***/ "./src/app/services/identity.service.ts":
/*!**********************************************!*\
  !*** ./src/app/services/identity.service.ts ***!
  \**********************************************/
/*! exports provided: IdentityService */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "IdentityService", function() { return IdentityService; });
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @angular/core */ "./node_modules/@angular/core/__ivy_ngcc__/fesm2015/core.js");


class IdentityService {
    constructor() {
        this.rights = {
            isAdmin: false
        };
    }
    SetRights(rights) {
        this.rights.isAdmin = rights.isAdmin;
    }
    isAdmin() {
        return this.rights.isAdmin;
    }
}
IdentityService.ɵfac = function IdentityService_Factory(t) { return new (t || IdentityService)(); };
IdentityService.ɵprov = _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵdefineInjectable"]({ token: IdentityService, factory: IdentityService.ɵfac, providedIn: 'root' });
/*@__PURE__*/ (function () { _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵsetClassMetadata"](IdentityService, [{
        type: _angular_core__WEBPACK_IMPORTED_MODULE_0__["Injectable"],
        args: [{
                providedIn: 'root'
            }]
    }], null, null); })();


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
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @angular/core */ "./node_modules/@angular/core/__ivy_ngcc__/fesm2015/core.js");
/* harmony import */ var _data_service__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./data.service */ "./src/app/services/data.service.ts");
/* harmony import */ var _angular_common_http__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @angular/common/http */ "./node_modules/@angular/common/__ivy_ngcc__/fesm2015/http.js");
/* harmony import */ var rxjs_Subject__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! rxjs/Subject */ "./node_modules/rxjs-compat/_esm2015/Subject.js");







class ImageService {
    constructor(dataService, http) {
        this.dataService = dataService;
        this.http = http;
        this.api_url = '/api/image/';
    }
    SubmitImages(data) {
        let url = this.api_url + data.id;
        let subject = new rxjs_Subject__WEBPACK_IMPORTED_MODULE_3__["Subject"]();
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
        let subject = new rxjs_Subject__WEBPACK_IMPORTED_MODULE_3__["Subject"]();
        this.http.delete(url)
            .subscribe(data => {
            subject.next({ success: data['success'], message: data['message'] });
        });
        return subject.asObservable();
    }
}
ImageService.ɵfac = function ImageService_Factory(t) { return new (t || ImageService)(_angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵinject"](_data_service__WEBPACK_IMPORTED_MODULE_1__["DataService"]), _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵinject"](_angular_common_http__WEBPACK_IMPORTED_MODULE_2__["HttpClient"])); };
ImageService.ɵprov = _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵdefineInjectable"]({ token: ImageService, factory: ImageService.ɵfac });
/*@__PURE__*/ (function () { _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵsetClassMetadata"](ImageService, [{
        type: _angular_core__WEBPACK_IMPORTED_MODULE_0__["Injectable"]
    }], function () { return [{ type: _data_service__WEBPACK_IMPORTED_MODULE_1__["DataService"] }, { type: _angular_common_http__WEBPACK_IMPORTED_MODULE_2__["HttpClient"] }]; }, null); })();


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
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @angular/core */ "./node_modules/@angular/core/__ivy_ngcc__/fesm2015/core.js");
/* harmony import */ var _data_service__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./data.service */ "./src/app/services/data.service.ts");
/* harmony import */ var _angular_common_http__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @angular/common/http */ "./node_modules/@angular/common/__ivy_ngcc__/fesm2015/http.js");






class PageDataService {
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
}
PageDataService.ɵfac = function PageDataService_Factory(t) { return new (t || PageDataService)(_angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵinject"](_data_service__WEBPACK_IMPORTED_MODULE_1__["DataService"]), _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵinject"](_angular_common_http__WEBPACK_IMPORTED_MODULE_2__["HttpClient"])); };
PageDataService.ɵprov = _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵdefineInjectable"]({ token: PageDataService, factory: PageDataService.ɵfac });
/*@__PURE__*/ (function () { _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵsetClassMetadata"](PageDataService, [{
        type: _angular_core__WEBPACK_IMPORTED_MODULE_0__["Injectable"]
    }], function () { return [{ type: _data_service__WEBPACK_IMPORTED_MODULE_1__["DataService"] }, { type: _angular_common_http__WEBPACK_IMPORTED_MODULE_2__["HttpClient"] }]; }, null); })();


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
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @angular/core */ "./node_modules/@angular/core/__ivy_ngcc__/fesm2015/core.js");
/* harmony import */ var _data_service__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./data.service */ "./src/app/services/data.service.ts");




class PageTitleService {
    constructor(service) {
        this.service = service;
        this.observer = service.getPageTitleObserver().subscribe(data => {
            document.title = data;
        });
    }
    ngOnDestroy() {
        this.observer.unsubscribe();
    }
}
PageTitleService.ɵfac = function PageTitleService_Factory(t) { return new (t || PageTitleService)(_angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵinject"](_data_service__WEBPACK_IMPORTED_MODULE_1__["DataService"])); };
PageTitleService.ɵprov = _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵdefineInjectable"]({ token: PageTitleService, factory: PageTitleService.ɵfac });
/*@__PURE__*/ (function () { _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵsetClassMetadata"](PageTitleService, [{
        type: _angular_core__WEBPACK_IMPORTED_MODULE_0__["Injectable"]
    }], function () { return [{ type: _data_service__WEBPACK_IMPORTED_MODULE_1__["DataService"] }]; }, null); })();


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
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @angular/core */ "./node_modules/@angular/core/__ivy_ngcc__/fesm2015/core.js");
/* harmony import */ var rxjs_Subject__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! rxjs/Subject */ "./node_modules/rxjs-compat/_esm2015/Subject.js");
/* harmony import */ var _angular_common_http__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @angular/common/http */ "./node_modules/@angular/common/__ivy_ngcc__/fesm2015/http.js");





class ThumbnailService {
    constructor(http) {
        this.http = http;
        this.api_url = '/api/thumbnail_status';
    }
    getStatus(data = null) {
        let subject = new rxjs_Subject__WEBPACK_IMPORTED_MODULE_1__["Subject"]();
        let params = data.join(',');
        let url = this.api_url + '?images=' + params;
        this.http.get(url).subscribe(data => {
            subject.next(data);
        });
        return subject.asObservable();
    }
}
ThumbnailService.ɵfac = function ThumbnailService_Factory(t) { return new (t || ThumbnailService)(_angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵinject"](_angular_common_http__WEBPACK_IMPORTED_MODULE_2__["HttpClient"])); };
ThumbnailService.ɵprov = _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵdefineInjectable"]({ token: ThumbnailService, factory: ThumbnailService.ɵfac });
/*@__PURE__*/ (function () { _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵsetClassMetadata"](ThumbnailService, [{
        type: _angular_core__WEBPACK_IMPORTED_MODULE_0__["Injectable"]
    }], function () { return [{ type: _angular_common_http__WEBPACK_IMPORTED_MODULE_2__["HttpClient"] }]; }, null); })();


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
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @angular/core */ "./node_modules/@angular/core/__ivy_ngcc__/fesm2015/core.js");
/* harmony import */ var _environments_environment__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./environments/environment */ "./src/environments/environment.ts");
/* harmony import */ var _app_app_module__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./app/app.module */ "./src/app/app.module.ts");
/* harmony import */ var _angular_platform_browser__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @angular/platform-browser */ "./node_modules/@angular/platform-browser/__ivy_ngcc__/fesm2015/platform-browser.js");




if (_environments_environment__WEBPACK_IMPORTED_MODULE_1__["environment"].production) {
    Object(_angular_core__WEBPACK_IMPORTED_MODULE_0__["enableProdMode"])();
}
_angular_platform_browser__WEBPACK_IMPORTED_MODULE_3__["platformBrowser"]().bootstrapModule(_app_app_module__WEBPACK_IMPORTED_MODULE_2__["AppModule"])
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