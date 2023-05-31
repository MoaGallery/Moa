"use strict";
(self["webpackChunkmoa_frontend"] = self["webpackChunkmoa_frontend"] || []).push([["main"],{

/***/ 5041:
/*!**********************************!*\
  !*** ./src/app/app.component.ts ***!
  \**********************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "AppComponent": () => (/* binding */ AppComponent)
/* harmony export */ });
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @angular/core */ 2560);
/* harmony import */ var _angular_router__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! @angular/router */ 124);
/* harmony import */ var _services_data_service__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./services/data.service */ 2468);
/* harmony import */ var _services_page_title_service__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./services/page_title.service */ 3279);
/* harmony import */ var _breadcrumb_breadcrumb_component__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./breadcrumb/breadcrumb.component */ 6723);





class AppComponent {
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
  static #_ = this.ɵfac = function AppComponent_Factory(t) {
    return new (t || AppComponent)(_angular_core__WEBPACK_IMPORTED_MODULE_3__["ɵɵdirectiveInject"](_angular_router__WEBPACK_IMPORTED_MODULE_4__.Router), _angular_core__WEBPACK_IMPORTED_MODULE_3__["ɵɵdirectiveInject"](_services_data_service__WEBPACK_IMPORTED_MODULE_0__.DataService), _angular_core__WEBPACK_IMPORTED_MODULE_3__["ɵɵdirectiveInject"](_services_page_title_service__WEBPACK_IMPORTED_MODULE_1__.PageTitleService), _angular_core__WEBPACK_IMPORTED_MODULE_3__["ɵɵdirectiveInject"](_angular_core__WEBPACK_IMPORTED_MODULE_3__.ElementRef));
  };
  static #_2 = this.ɵcmp = /*@__PURE__*/_angular_core__WEBPACK_IMPORTED_MODULE_3__["ɵɵdefineComponent"]({
    type: AppComponent,
    selectors: [["app-root"]],
    decls: 2,
    vars: 0,
    template: function AppComponent_Template(rf, ctx) {
      if (rf & 1) {
        _angular_core__WEBPACK_IMPORTED_MODULE_3__["ɵɵelement"](0, "breadcrumb")(1, "router-outlet");
      }
    },
    dependencies: [_angular_router__WEBPACK_IMPORTED_MODULE_4__.RouterOutlet, _breadcrumb_breadcrumb_component__WEBPACK_IMPORTED_MODULE_2__.BreadcrumbComponent],
    styles: ["\n/*# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbXSwibmFtZXMiOltdLCJtYXBwaW5ncyI6IiIsInNvdXJjZVJvb3QiOiIifQ== */"]
  });
}

/***/ }),

/***/ 6747:
/*!*******************************!*\
  !*** ./src/app/app.module.ts ***!
  \*******************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "AppModule": () => (/* binding */ AppModule)
/* harmony export */ });
/* harmony import */ var _angular_platform_browser__WEBPACK_IMPORTED_MODULE_36__ = __webpack_require__(/*! @angular/platform-browser */ 4497);
/* harmony import */ var _app_component__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./app.component */ 5041);
/* harmony import */ var _breadcrumb_breadcrumb_component__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./breadcrumb/breadcrumb.component */ 6723);
/* harmony import */ var _gallery_gallery_list_gallery_list_component__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./gallery/gallery-list/gallery-list.component */ 8072);
/* harmony import */ var _gallery_gallery_tile_gallery_tile_component__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./gallery/gallery-tile/gallery-tile.component */ 4511);
/* harmony import */ var _services_data_service__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ./services/data.service */ 2468);
/* harmony import */ var _services_page_title_service__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! ./services/page_title.service */ 3279);
/* harmony import */ var _services_page_data_service__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! ./services/page_data.service */ 5914);
/* harmony import */ var _angular_common_http__WEBPACK_IMPORTED_MODULE_37__ = __webpack_require__(/*! @angular/common/http */ 8987);
/* harmony import */ var _angular_router__WEBPACK_IMPORTED_MODULE_38__ = __webpack_require__(/*! @angular/router */ 124);
/* harmony import */ var _pages_gallery_page_gallery_page_component__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(/*! ./pages/gallery-page/gallery-page.component */ 3276);
/* harmony import */ var _pages_home_page_home_page_component__WEBPACK_IMPORTED_MODULE_8__ = __webpack_require__(/*! ./pages/home-page/home-page.component */ 8043);
/* harmony import */ var _gallery_gallery_info_gallery_info_component__WEBPACK_IMPORTED_MODULE_9__ = __webpack_require__(/*! ./gallery/gallery-info/gallery-info.component */ 7022);
/* harmony import */ var _image_image_list_image_list_component__WEBPACK_IMPORTED_MODULE_10__ = __webpack_require__(/*! ./image/image-list/image-list.component */ 3128);
/* harmony import */ var _image_image_thumb_image_thumb_component__WEBPACK_IMPORTED_MODULE_11__ = __webpack_require__(/*! ./image/image-thumb/image-thumb.component */ 3744);
/* harmony import */ var _gallery_gallery_toolbar_gallery_toolbar_component__WEBPACK_IMPORTED_MODULE_12__ = __webpack_require__(/*! ./gallery/gallery-toolbar/gallery-toolbar.component */ 5923);
/* harmony import */ var _gallery_gallery_edit_gallery_edit_component__WEBPACK_IMPORTED_MODULE_13__ = __webpack_require__(/*! ./gallery/gallery-edit/gallery-edit.component */ 9188);
/* harmony import */ var _services_button_click_service__WEBPACK_IMPORTED_MODULE_14__ = __webpack_require__(/*! ./services/button-click.service */ 4872);
/* harmony import */ var _angular_forms__WEBPACK_IMPORTED_MODULE_39__ = __webpack_require__(/*! @angular/forms */ 2508);
/* harmony import */ var _gallery_gallery_service__WEBPACK_IMPORTED_MODULE_15__ = __webpack_require__(/*! ./gallery/gallery.service */ 8422);
/* harmony import */ var _image_image_service__WEBPACK_IMPORTED_MODULE_16__ = __webpack_require__(/*! ./image/image.service */ 964);
/* harmony import */ var _pages_image_page_image_page_component__WEBPACK_IMPORTED_MODULE_17__ = __webpack_require__(/*! ./pages/image-page/image-page.component */ 2141);
/* harmony import */ var _image_image_info_image_info_component__WEBPACK_IMPORTED_MODULE_18__ = __webpack_require__(/*! ./image/image-info/image-info.component */ 386);
/* harmony import */ var _image_image_toolbar_image_toolbar_component__WEBPACK_IMPORTED_MODULE_19__ = __webpack_require__(/*! ./image/image-toolbar/image-toolbar.component */ 9458);
/* harmony import */ var _image_image_edit_image_edit_component__WEBPACK_IMPORTED_MODULE_20__ = __webpack_require__(/*! ./image/image-edit/image-edit.component */ 6424);
/* harmony import */ var _services_thumbnail_service__WEBPACK_IMPORTED_MODULE_21__ = __webpack_require__(/*! ./services/thumbnail.service */ 4204);
/* harmony import */ var _image_image_add_image_add_component__WEBPACK_IMPORTED_MODULE_22__ = __webpack_require__(/*! ./image/image-add/image-add.component */ 1963);
/* harmony import */ var primeng_fileupload__WEBPACK_IMPORTED_MODULE_40__ = __webpack_require__(/*! primeng/fileupload */ 6193);
/* harmony import */ var _home_home_toolbar_home_toolbar_component__WEBPACK_IMPORTED_MODULE_23__ = __webpack_require__(/*! ./home/home-toolbar/home-toolbar.component */ 5434);
/* harmony import */ var _ngbox_ngbox_service__WEBPACK_IMPORTED_MODULE_24__ = __webpack_require__(/*! ./ngbox/ngbox.service */ 1571);
/* harmony import */ var _ngbox_ngbox_component__WEBPACK_IMPORTED_MODULE_25__ = __webpack_require__(/*! ./ngbox/ngbox.component */ 3995);
/* harmony import */ var _ngbox_ngbox_directive__WEBPACK_IMPORTED_MODULE_26__ = __webpack_require__(/*! ./ngbox/ngbox.directive */ 4126);
/* harmony import */ var _ngrx_data__WEBPACK_IMPORTED_MODULE_35__ = __webpack_require__(/*! @ngrx/data */ 781);
/* harmony import */ var _ngrx_store__WEBPACK_IMPORTED_MODULE_41__ = __webpack_require__(/*! @ngrx/store */ 3488);
/* harmony import */ var _ngrx_effects__WEBPACK_IMPORTED_MODULE_43__ = __webpack_require__(/*! @ngrx/effects */ 5405);
/* harmony import */ var _ngrx_store_devtools__WEBPACK_IMPORTED_MODULE_42__ = __webpack_require__(/*! @ngrx/store-devtools */ 5242);
/* harmony import */ var _environments_environment__WEBPACK_IMPORTED_MODULE_27__ = __webpack_require__(/*! ../environments/environment */ 2340);
/* harmony import */ var _reducers__WEBPACK_IMPORTED_MODULE_28__ = __webpack_require__(/*! ./reducers */ 1697);
/* harmony import */ var _ngrx_router_store__WEBPACK_IMPORTED_MODULE_44__ = __webpack_require__(/*! @ngrx/router-store */ 1611);
/* harmony import */ var _services_simple_gallery_data_service__WEBPACK_IMPORTED_MODULE_29__ = __webpack_require__(/*! ./services/simple_gallery.data.service */ 5599);
/* harmony import */ var _services_simple_gallery_entity_service__WEBPACK_IMPORTED_MODULE_30__ = __webpack_require__(/*! ./services/simple_gallery-entity.service */ 2889);
/* harmony import */ var _gallery_gallery_module__WEBPACK_IMPORTED_MODULE_31__ = __webpack_require__(/*! ./gallery/gallery.module */ 8632);
/* harmony import */ var _state_app_effect__WEBPACK_IMPORTED_MODULE_32__ = __webpack_require__(/*! ./state/app.effect */ 2297);
/* harmony import */ var _app_service__WEBPACK_IMPORTED_MODULE_33__ = __webpack_require__(/*! ./app.service */ 900);
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_34__ = __webpack_require__(/*! @angular/core */ 2560);




















































const routes = [{
  path: '',
  component: _pages_home_page_home_page_component__WEBPACK_IMPORTED_MODULE_8__.HomePageComponent
}, {
  path: 'gallery/:gallery_id',
  component: _pages_gallery_page_gallery_page_component__WEBPACK_IMPORTED_MODULE_7__.GalleryPageComponent,
  resolve: {
    //gallery: GalleryResolver
  }
}, {
  path: 'image/:gallery_id/:image_id',
  component: _pages_image_page_image_page_component__WEBPACK_IMPORTED_MODULE_17__.ImagePageComponent
}];
const entityMetadata = {
  Gallery: {
    entityDispatcherOptions: {
      optimisticUpdate: true
    }
  },
  SimpleGallery: {}
};
class AppModule {
  constructor(eds, entityDataService, simpleGalleryDataService) {
    this.eds = eds;
    this.entityDataService = entityDataService;
    this.simpleGalleryDataService = simpleGalleryDataService;
    eds.registerMetadataMap(entityMetadata);
    entityDataService.registerService('SimpleGallery', this.simpleGalleryDataService);
  }
  static #_ = this.ɵfac = function AppModule_Factory(t) {
    return new (t || AppModule)(_angular_core__WEBPACK_IMPORTED_MODULE_34__["ɵɵinject"](_ngrx_data__WEBPACK_IMPORTED_MODULE_35__.EntityDefinitionService), _angular_core__WEBPACK_IMPORTED_MODULE_34__["ɵɵinject"](_ngrx_data__WEBPACK_IMPORTED_MODULE_35__.EntityDataService), _angular_core__WEBPACK_IMPORTED_MODULE_34__["ɵɵinject"](_services_simple_gallery_data_service__WEBPACK_IMPORTED_MODULE_29__.SimpleGalleryDataService));
  };
  static #_2 = this.ɵmod = /*@__PURE__*/_angular_core__WEBPACK_IMPORTED_MODULE_34__["ɵɵdefineNgModule"]({
    type: AppModule,
    bootstrap: [_app_component__WEBPACK_IMPORTED_MODULE_0__.AppComponent]
  });
  static #_3 = this.ɵinj = /*@__PURE__*/_angular_core__WEBPACK_IMPORTED_MODULE_34__["ɵɵdefineInjector"]({
    providers: [_services_data_service__WEBPACK_IMPORTED_MODULE_4__.DataService, _services_page_title_service__WEBPACK_IMPORTED_MODULE_5__.PageTitleService, _services_page_data_service__WEBPACK_IMPORTED_MODULE_6__.PageDataService, _services_button_click_service__WEBPACK_IMPORTED_MODULE_14__.ButtonClickService, _gallery_gallery_service__WEBPACK_IMPORTED_MODULE_15__.GalleryService, _image_image_service__WEBPACK_IMPORTED_MODULE_16__.ImageService, _app_service__WEBPACK_IMPORTED_MODULE_33__.AppService, _services_thumbnail_service__WEBPACK_IMPORTED_MODULE_21__.ThumbnailService, _ngbox_ngbox_service__WEBPACK_IMPORTED_MODULE_24__.NgBoxService, _services_simple_gallery_data_service__WEBPACK_IMPORTED_MODULE_29__.SimpleGalleryDataService, _services_simple_gallery_entity_service__WEBPACK_IMPORTED_MODULE_30__.SimpleGalleryEntityService],
    imports: [_angular_platform_browser__WEBPACK_IMPORTED_MODULE_36__.BrowserModule, _angular_common_http__WEBPACK_IMPORTED_MODULE_37__.HttpClientModule, _angular_router__WEBPACK_IMPORTED_MODULE_38__.RouterModule.forRoot(routes, {}), _angular_forms__WEBPACK_IMPORTED_MODULE_39__.FormsModule, primeng_fileupload__WEBPACK_IMPORTED_MODULE_40__.FileUploadModule, _ngrx_store__WEBPACK_IMPORTED_MODULE_41__.StoreModule.forRoot(_reducers__WEBPACK_IMPORTED_MODULE_28__.reducers, {
      metaReducers: _reducers__WEBPACK_IMPORTED_MODULE_28__.metaReducers,
      runtimeChecks: {
        strictStateImmutability: true,
        strictActionImmutability: true,
        strictActionSerializability: true,
        strictStateSerializability: true
      }
    }), _gallery_gallery_module__WEBPACK_IMPORTED_MODULE_31__.GalleryModule, _ngrx_store_devtools__WEBPACK_IMPORTED_MODULE_42__.StoreDevtoolsModule.instrument({
      maxAge: 25,
      logOnly: _environments_environment__WEBPACK_IMPORTED_MODULE_27__.environment.production
    }), _ngrx_effects__WEBPACK_IMPORTED_MODULE_43__.EffectsModule.forRoot([_state_app_effect__WEBPACK_IMPORTED_MODULE_32__.AppEffect]), _ngrx_data__WEBPACK_IMPORTED_MODULE_35__.EntityDataModule.forRoot({}), _ngrx_router_store__WEBPACK_IMPORTED_MODULE_44__.StoreRouterConnectingModule.forRoot({
      stateKey: 'router',
      routerState: 1 /* RouterState.Minimal */
    })]
  });
}

(function () {
  (typeof ngJitMode === "undefined" || ngJitMode) && _angular_core__WEBPACK_IMPORTED_MODULE_34__["ɵɵsetNgModuleScope"](AppModule, {
    declarations: [_app_component__WEBPACK_IMPORTED_MODULE_0__.AppComponent, _breadcrumb_breadcrumb_component__WEBPACK_IMPORTED_MODULE_1__.BreadcrumbComponent, _gallery_gallery_list_gallery_list_component__WEBPACK_IMPORTED_MODULE_2__.GalleryListComponent, _gallery_gallery_tile_gallery_tile_component__WEBPACK_IMPORTED_MODULE_3__.GalleryTileComponent, _gallery_gallery_info_gallery_info_component__WEBPACK_IMPORTED_MODULE_9__.GalleryInfoComponent, _gallery_gallery_toolbar_gallery_toolbar_component__WEBPACK_IMPORTED_MODULE_12__.GalleryToolbarComponent, _gallery_gallery_edit_gallery_edit_component__WEBPACK_IMPORTED_MODULE_13__.GalleryEditComponent, _image_image_list_image_list_component__WEBPACK_IMPORTED_MODULE_10__.ImageListComponent, _image_image_thumb_image_thumb_component__WEBPACK_IMPORTED_MODULE_11__.ImageThumbComponent, _image_image_info_image_info_component__WEBPACK_IMPORTED_MODULE_18__.ImageInfoComponent, _home_home_toolbar_home_toolbar_component__WEBPACK_IMPORTED_MODULE_23__.HomeToolbarComponent,
    // Route pages
    _pages_home_page_home_page_component__WEBPACK_IMPORTED_MODULE_8__.HomePageComponent, _pages_gallery_page_gallery_page_component__WEBPACK_IMPORTED_MODULE_7__.GalleryPageComponent, _pages_image_page_image_page_component__WEBPACK_IMPORTED_MODULE_17__.ImagePageComponent, _image_image_toolbar_image_toolbar_component__WEBPACK_IMPORTED_MODULE_19__.ImageToolbarComponent, _image_image_edit_image_edit_component__WEBPACK_IMPORTED_MODULE_20__.ImageEditComponent, _image_image_add_image_add_component__WEBPACK_IMPORTED_MODULE_22__.ImageAddComponent, _ngbox_ngbox_component__WEBPACK_IMPORTED_MODULE_25__.NgBoxComponent, _ngbox_ngbox_directive__WEBPACK_IMPORTED_MODULE_26__.NgBoxDirective],
    imports: [_angular_platform_browser__WEBPACK_IMPORTED_MODULE_36__.BrowserModule, _angular_common_http__WEBPACK_IMPORTED_MODULE_37__.HttpClientModule, _angular_router__WEBPACK_IMPORTED_MODULE_38__.RouterModule, _angular_forms__WEBPACK_IMPORTED_MODULE_39__.FormsModule, primeng_fileupload__WEBPACK_IMPORTED_MODULE_40__.FileUploadModule, _ngrx_store__WEBPACK_IMPORTED_MODULE_41__.StoreRootModule, _gallery_gallery_module__WEBPACK_IMPORTED_MODULE_31__.GalleryModule, _ngrx_store_devtools__WEBPACK_IMPORTED_MODULE_42__.StoreDevtoolsModule, _ngrx_effects__WEBPACK_IMPORTED_MODULE_43__.EffectsRootModule, _ngrx_data__WEBPACK_IMPORTED_MODULE_35__.EntityDataModule, _ngrx_router_store__WEBPACK_IMPORTED_MODULE_44__.StoreRouterConnectingModule]
  });
})();

/***/ }),

/***/ 900:
/*!********************************!*\
  !*** ./src/app/app.service.ts ***!
  \********************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "AppService": () => (/* binding */ AppService)
/* harmony export */ });
/* harmony import */ var rxjs__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! rxjs */ 6587);
/* harmony import */ var rxjs_operators__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! rxjs/operators */ 7418);
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @angular/core */ 2560);
/* harmony import */ var _angular_common_http__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @angular/common/http */ 8987);




class AppService {
  constructor(http) {
    this.http = http;
    this.api_url = '/api/other/';
  }
  handleError(err) {
    // in a real world app, we may send the server to some remote logging infrastructure
    // instead of just logging it to the console
    let errorMessage;
    if (err.error instanceof ErrorEvent) {
      // A client-side or network error occurred. Handle it accordingly.
      errorMessage = `An error occurred: ${err.error.message}`;
    } else {
      // The backend returned an unsuccessful response code.
      // The response body may contain clues as to what went wrong,
      errorMessage = `Backend returned code ${err.status}: ${err.body.error}`;
    }
    console.error(err);
    return (0,rxjs__WEBPACK_IMPORTED_MODULE_0__.throwError)(errorMessage);
  }
  getOtherData() {
    return this.http.get(this.api_url).pipe( /*tap(data => console.log(JSON.stringify(data))),*/
    (0,rxjs_operators__WEBPACK_IMPORTED_MODULE_1__.catchError)(this.handleError));
  }
  static #_ = this.ɵfac = function AppService_Factory(t) {
    return new (t || AppService)(_angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵinject"](_angular_common_http__WEBPACK_IMPORTED_MODULE_3__.HttpClient));
  };
  static #_2 = this.ɵprov = /*@__PURE__*/_angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵdefineInjectable"]({
    token: AppService,
    factory: AppService.ɵfac
  });
}

/***/ }),

/***/ 6723:
/*!****************************************************!*\
  !*** ./src/app/breadcrumb/breadcrumb.component.ts ***!
  \****************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "BreadcrumbComponent": () => (/* binding */ BreadcrumbComponent)
/* harmony export */ });
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @angular/core */ 2560);
/* harmony import */ var _services_data_service__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../services/data.service */ 2468);
/* harmony import */ var _angular_common__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @angular/common */ 4666);
/* harmony import */ var _angular_router__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @angular/router */ 124);




const _c0 = function (a0) {
  return [a0];
};
function BreadcrumbComponent_li_4_a_1_Template(rf, ctx) {
  if (rf & 1) {
    _angular_core__WEBPACK_IMPORTED_MODULE_1__["ɵɵelementStart"](0, "a", 1);
    _angular_core__WEBPACK_IMPORTED_MODULE_1__["ɵɵtext"](1);
    _angular_core__WEBPACK_IMPORTED_MODULE_1__["ɵɵelementEnd"]();
  }
  if (rf & 2) {
    const crumb_r1 = _angular_core__WEBPACK_IMPORTED_MODULE_1__["ɵɵnextContext"]().$implicit;
    const ctx_r3 = _angular_core__WEBPACK_IMPORTED_MODULE_1__["ɵɵnextContext"]();
    _angular_core__WEBPACK_IMPORTED_MODULE_1__["ɵɵproperty"]("routerLink", _angular_core__WEBPACK_IMPORTED_MODULE_1__["ɵɵpureFunction1"](2, _c0, ctx_r3.getLink(crumb_r1.id)));
    _angular_core__WEBPACK_IMPORTED_MODULE_1__["ɵɵadvance"](1);
    _angular_core__WEBPACK_IMPORTED_MODULE_1__["ɵɵtextInterpolate"](crumb_r1.name);
  }
}
function BreadcrumbComponent_li_4_span_2_Template(rf, ctx) {
  if (rf & 1) {
    _angular_core__WEBPACK_IMPORTED_MODULE_1__["ɵɵelementStart"](0, "span");
    _angular_core__WEBPACK_IMPORTED_MODULE_1__["ɵɵtext"](1);
    _angular_core__WEBPACK_IMPORTED_MODULE_1__["ɵɵelementEnd"]();
  }
  if (rf & 2) {
    const crumb_r1 = _angular_core__WEBPACK_IMPORTED_MODULE_1__["ɵɵnextContext"]().$implicit;
    _angular_core__WEBPACK_IMPORTED_MODULE_1__["ɵɵadvance"](1);
    _angular_core__WEBPACK_IMPORTED_MODULE_1__["ɵɵtextInterpolate"](crumb_r1.name);
  }
}
function BreadcrumbComponent_li_4_Template(rf, ctx) {
  if (rf & 1) {
    _angular_core__WEBPACK_IMPORTED_MODULE_1__["ɵɵelementStart"](0, "li");
    _angular_core__WEBPACK_IMPORTED_MODULE_1__["ɵɵtemplate"](1, BreadcrumbComponent_li_4_a_1_Template, 2, 4, "a", 3);
    _angular_core__WEBPACK_IMPORTED_MODULE_1__["ɵɵtemplate"](2, BreadcrumbComponent_li_4_span_2_Template, 2, 1, "span", 4);
    _angular_core__WEBPACK_IMPORTED_MODULE_1__["ɵɵelementEnd"]();
  }
  if (rf & 2) {
    const last_r2 = ctx.last;
    _angular_core__WEBPACK_IMPORTED_MODULE_1__["ɵɵadvance"](1);
    _angular_core__WEBPACK_IMPORTED_MODULE_1__["ɵɵproperty"]("ngIf", !last_r2);
    _angular_core__WEBPACK_IMPORTED_MODULE_1__["ɵɵadvance"](1);
    _angular_core__WEBPACK_IMPORTED_MODULE_1__["ɵɵproperty"]("ngIf", last_r2);
  }
}
const _c1 = function () {
  return ["/"];
};
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
  static #_ = this.ɵfac = function BreadcrumbComponent_Factory(t) {
    return new (t || BreadcrumbComponent)(_angular_core__WEBPACK_IMPORTED_MODULE_1__["ɵɵdirectiveInject"](_services_data_service__WEBPACK_IMPORTED_MODULE_0__.DataService));
  };
  static #_2 = this.ɵcmp = /*@__PURE__*/_angular_core__WEBPACK_IMPORTED_MODULE_1__["ɵɵdefineComponent"]({
    type: BreadcrumbComponent,
    selectors: [["breadcrumb"]],
    decls: 5,
    vars: 3,
    consts: [[1, "breadcrumb"], [3, "routerLink"], [4, "ngFor", "ngForOf"], [3, "routerLink", 4, "ngIf"], [4, "ngIf"]],
    template: function BreadcrumbComponent_Template(rf, ctx) {
      if (rf & 1) {
        _angular_core__WEBPACK_IMPORTED_MODULE_1__["ɵɵelementStart"](0, "ol", 0)(1, "li")(2, "a", 1);
        _angular_core__WEBPACK_IMPORTED_MODULE_1__["ɵɵtext"](3, "Home");
        _angular_core__WEBPACK_IMPORTED_MODULE_1__["ɵɵelementEnd"]()();
        _angular_core__WEBPACK_IMPORTED_MODULE_1__["ɵɵtemplate"](4, BreadcrumbComponent_li_4_Template, 3, 2, "li", 2);
        _angular_core__WEBPACK_IMPORTED_MODULE_1__["ɵɵelementEnd"]();
      }
      if (rf & 2) {
        _angular_core__WEBPACK_IMPORTED_MODULE_1__["ɵɵadvance"](2);
        _angular_core__WEBPACK_IMPORTED_MODULE_1__["ɵɵproperty"]("routerLink", _angular_core__WEBPACK_IMPORTED_MODULE_1__["ɵɵpureFunction0"](2, _c1));
        _angular_core__WEBPACK_IMPORTED_MODULE_1__["ɵɵadvance"](2);
        _angular_core__WEBPACK_IMPORTED_MODULE_1__["ɵɵproperty"]("ngForOf", ctx.crumbs);
      }
    },
    dependencies: [_angular_common__WEBPACK_IMPORTED_MODULE_2__.NgForOf, _angular_common__WEBPACK_IMPORTED_MODULE_2__.NgIf, _angular_router__WEBPACK_IMPORTED_MODULE_3__.RouterLink],
    styles: ["\n/*# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbXSwibmFtZXMiOltdLCJtYXBwaW5ncyI6IiIsInNvdXJjZVJvb3QiOiIifQ== */"]
  });
}

/***/ }),

/***/ 9188:
/*!****************************************************************!*\
  !*** ./src/app/gallery/gallery-edit/gallery-edit.component.ts ***!
  \****************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "GalleryEditComponent": () => (/* binding */ GalleryEditComponent)
/* harmony export */ });
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @angular/core */ 2560);
/* harmony import */ var _services_button_click_service__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../../services/button-click.service */ 4872);
/* harmony import */ var _gallery_service__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../gallery.service */ 8422);
/* harmony import */ var _angular_router__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @angular/router */ 124);
/* harmony import */ var _angular_common__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! @angular/common */ 4666);
/* harmony import */ var _angular_forms__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! @angular/forms */ 2508);






function GalleryEditComponent_select_25_Template(rf, ctx) {
  if (rf & 1) {
    _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵelementStart"](0, "select", 29)(1, "option", 30);
    _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵtext"](2);
    _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵelementEnd"]()();
  }
  if (rf & 2) {
    const ctx_r0 = _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵnextContext"]();
    _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵadvance"](1);
    _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵpropertyInterpolate"]("value", ctx_r0.gallery.parentGallery.id);
    _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵadvance"](1);
    _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵtextInterpolate"](ctx_r0.gallery.parentGallery.name);
  }
}
function GalleryEditComponent_option_31_Template(rf, ctx) {
  if (rf & 1) {
    _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵelementStart"](0, "option", 30);
    _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵtext"](1);
    _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵelementEnd"]();
  }
  if (rf & 2) {
    const tag_r2 = ctx.$implicit;
    _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵpropertyInterpolate"]("value", tag_r2.id);
    _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵadvance"](1);
    _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵtextInterpolate"](tag_r2.name);
  }
}
class GalleryEditComponent {
  constructor(buttonClickService, galleryService, router) {
    this.buttonClickService = buttonClickService;
    this.galleryService = galleryService;
    this.router = router;
    this.addMode = false;
    this.tagList = [];
    this.name = '';
    this.description = '';
    this.useTags = false;
    this.showImages = false;
    this.subscription = this.buttonClickService.notifyObservable$.subscribe(data => {
      if (data.name !== 'galleryEditClick' && data.name !== 'galleryAddClick') {
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
      this.useTags = this.gallery.useTags;
      this.showImages = this.gallery.combinedView;
    } else {
      this.name = '';
      this.description = '';
      this.useTags = true;
      this.showImages = false;
    }
    this.tagList = [];
    for (let tag of this.gallery.tagList) {
      this.tagList.push({
        name: tag.name,
        id: '' + tag.id
      });
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
    this.gallery.parentGallery.id = galleryData[0].id;
    let id = 0;
    if (!this.addMode) id = this.gallery.id;
    /*this.galleryService.SubmitGallery({
        id: id,
        name: this.name,
        description: this.description,
        parent: this.gallery.parentGallery.id,
        tags: tags,
        useTags: this.useTags,
        showImages: this.showImages
    }).subscribe(data => {
        let options =
        {
            message: 'Gallery saved',
            container: '#editSuccessContainer',
            duration: 5000
        };
        $.meow(options);
        $('#inputGalleryTags').children().remove();
        $('#edit-modal').modal('hide');
         if (this.addMode) {
            this.router.navigate(['/gallery/' + data.message])
        }
    });*/
  }

  ngOnDestroy() {
    this.subscription.unsubscribe();
  }
  static #_ = this.ɵfac = function GalleryEditComponent_Factory(t) {
    return new (t || GalleryEditComponent)(_angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵdirectiveInject"](_services_button_click_service__WEBPACK_IMPORTED_MODULE_0__.ButtonClickService), _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵdirectiveInject"](_gallery_service__WEBPACK_IMPORTED_MODULE_1__.GalleryService), _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵdirectiveInject"](_angular_router__WEBPACK_IMPORTED_MODULE_3__.Router));
  };
  static #_2 = this.ɵcmp = /*@__PURE__*/_angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵdefineComponent"]({
    type: GalleryEditComponent,
    selectors: [["gallery-edit"]],
    inputs: {
      gallery: "gallery"
    },
    decls: 50,
    vars: 7,
    consts: [["id", "edit-modal", 1, "modal", "fade"], [1, "modal-dialog"], [1, "modal-content"], [1, "modal-header"], ["type", "button", "data-dismiss", "modal", "aria-label", "Close", 1, "close"], ["aria-hidden", "true"], [1, "modal-title"], ["method", "post", 1, "form-horizontal", 3, "action"], [1, "modal-body"], [1, "form-group"], ["for", "inputGalleryName", 1, "col-sm-2", "control-label"], [1, "col-sm-10"], ["type", "text", "name", "inputGalleryName", "id", "inputGalleryName", "placeholder", "Edit...", 1, "form-control", 3, "ngModel", "ngModelChange"], ["for", "inputGalleryDescription", 1, "col-sm-2", "control-label"], ["name", "inputGalleryDescription", "id", "inputGalleryDescription", "placeholder", "Edit...", 1, "form-control", 3, "ngModel", "ngModelChange"], ["for", "inputGalleryParent", 1, "col-sm-2", "control-label"], ["class", "form-control", "name", "inputGalleryParent", "id", "inputGalleryParent", "style", "width: 100%", 4, "ngIf"], ["for", "inputGalleryTags", 1, "col-sm-2", "control-label"], ["name", "inputGalleryTags[]", "id", "inputGalleryTags", "multiple", "", 1, "form-control", 2, "width", "100%"], ["selected", "selected", 3, "value", 4, "ngFor", "ngForOf"], [1, "checkbox"], [1, "col-sm-2"], ["type", "checkbox", "name", "inputGalleryCombinedView", "id", "inputGalleryCombinedView", 3, "ngModel", "ngModelChange"], ["for", "inputGalleryCombinedView", 1, "control-label"], ["type", "checkbox", "name", "inputGalleryUseTags", "id", "inputGalleryUseTags", 3, "ngModel", "ngModelChange"], ["for", "inputGalleryUseTags", 1, "control-label"], [1, "modal-footer"], ["type", "button", "data-dismiss", "modal", 1, "btn", "btn-default"], ["type", "submit", "value", "Save changes", 1, "btn", "btn-primary", 3, "click"], ["name", "inputGalleryParent", "id", "inputGalleryParent", 1, "form-control", 2, "width", "100%"], ["selected", "selected", 3, "value"]],
    template: function GalleryEditComponent_Template(rf, ctx) {
      if (rf & 1) {
        _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵelementStart"](0, "div", 0)(1, "div", 1)(2, "div", 2)(3, "div", 3)(4, "button", 4)(5, "span", 5);
        _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵtext"](6, "\u00D7");
        _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵelementEnd"]()();
        _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵelementStart"](7, "h4", 6);
        _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵtext"](8, "Edit gallery");
        _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵelementEnd"]()();
        _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵelementStart"](9, "form", 7)(10, "div", 8)(11, "div", 9)(12, "label", 10);
        _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵtext"](13, "Name");
        _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵelementEnd"]();
        _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵelementStart"](14, "div", 11)(15, "input", 12);
        _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵlistener"]("ngModelChange", function GalleryEditComponent_Template_input_ngModelChange_15_listener($event) {
          return ctx.name = $event;
        });
        _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵelementEnd"]()()();
        _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵelementStart"](16, "div", 9)(17, "label", 13);
        _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵtext"](18, "Description");
        _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵelementEnd"]();
        _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵelementStart"](19, "div", 11)(20, "textarea", 14);
        _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵlistener"]("ngModelChange", function GalleryEditComponent_Template_textarea_ngModelChange_20_listener($event) {
          return ctx.description = $event;
        });
        _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵelementEnd"]()()();
        _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵelementStart"](21, "div", 9)(22, "label", 15);
        _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵtext"](23, "Parent");
        _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵelementEnd"]();
        _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵelementStart"](24, "div", 11);
        _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵtemplate"](25, GalleryEditComponent_select_25_Template, 3, 2, "select", 16);
        _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵelementEnd"]()();
        _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵelementStart"](26, "div", 9)(27, "label", 17);
        _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵtext"](28, "Tags");
        _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵelementEnd"]();
        _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵelementStart"](29, "div", 11)(30, "select", 18);
        _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵtemplate"](31, GalleryEditComponent_option_31_Template, 2, 2, "option", 19);
        _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵelementEnd"]()()();
        _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵelementStart"](32, "div", 9)(33, "div", 20);
        _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵelement"](34, "div", 21);
        _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵelementStart"](35, "div", 11)(36, "input", 22);
        _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵlistener"]("ngModelChange", function GalleryEditComponent_Template_input_ngModelChange_36_listener($event) {
          return ctx.showImages = $event;
        });
        _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵelementEnd"]();
        _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵelementStart"](37, "label", 23);
        _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵtext"](38, "Show images when there are subgalleries");
        _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵelementEnd"]()()()();
        _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵelementStart"](39, "div", 9)(40, "div", 20);
        _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵelement"](41, "div", 21);
        _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵelementStart"](42, "div", 11)(43, "input", 24);
        _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵlistener"]("ngModelChange", function GalleryEditComponent_Template_input_ngModelChange_43_listener($event) {
          return ctx.useTags = $event;
        });
        _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵelementEnd"]();
        _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵelementStart"](44, "label", 25);
        _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵtext"](45, "Populate from tags");
        _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵelementEnd"]()()()()();
        _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵelementStart"](46, "div", 26)(47, "button", 27);
        _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵtext"](48, "Close");
        _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵelementEnd"]();
        _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵelementStart"](49, "input", 28);
        _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵlistener"]("click", function GalleryEditComponent_Template_input_click_49_listener() {
          return ctx.onSubmit();
        });
        _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵelementEnd"]()()()()()();
      }
      if (rf & 2) {
        _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵadvance"](9);
        _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵpropertyInterpolate1"]("action", "/gallery/", ctx.gallery.id, "", _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵsanitizeUrl"]);
        _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵadvance"](6);
        _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵproperty"]("ngModel", ctx.name);
        _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵadvance"](5);
        _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵproperty"]("ngModel", ctx.description);
        _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵadvance"](5);
        _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵproperty"]("ngIf", ctx.gallery.parentGallery !== undefined);
        _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵadvance"](6);
        _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵproperty"]("ngForOf", ctx.tagList);
        _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵadvance"](5);
        _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵproperty"]("ngModel", ctx.showImages);
        _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵadvance"](7);
        _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵproperty"]("ngModel", ctx.useTags);
      }
    },
    dependencies: [_angular_common__WEBPACK_IMPORTED_MODULE_4__.NgForOf, _angular_common__WEBPACK_IMPORTED_MODULE_4__.NgIf, _angular_forms__WEBPACK_IMPORTED_MODULE_5__["ɵNgNoValidate"], _angular_forms__WEBPACK_IMPORTED_MODULE_5__.NgSelectOption, _angular_forms__WEBPACK_IMPORTED_MODULE_5__["ɵNgSelectMultipleOption"], _angular_forms__WEBPACK_IMPORTED_MODULE_5__.DefaultValueAccessor, _angular_forms__WEBPACK_IMPORTED_MODULE_5__.CheckboxControlValueAccessor, _angular_forms__WEBPACK_IMPORTED_MODULE_5__.NgControlStatus, _angular_forms__WEBPACK_IMPORTED_MODULE_5__.NgControlStatusGroup, _angular_forms__WEBPACK_IMPORTED_MODULE_5__.NgModel, _angular_forms__WEBPACK_IMPORTED_MODULE_5__.NgForm],
    styles: ["\n/*# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbXSwibmFtZXMiOltdLCJtYXBwaW5ncyI6IiIsInNvdXJjZVJvb3QiOiIifQ== */"]
  });
}

/***/ }),

/***/ 7022:
/*!****************************************************************!*\
  !*** ./src/app/gallery/gallery-info/gallery-info.component.ts ***!
  \****************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "GalleryInfoComponent": () => (/* binding */ GalleryInfoComponent)
/* harmony export */ });
/* harmony import */ var _state_gallery_selector__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../state/gallery.selector */ 4806);
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @angular/core */ 2560);
/* harmony import */ var _ngrx_store__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @ngrx/store */ 3488);
/* harmony import */ var _angular_common__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @angular/common */ 4666);




function GalleryInfoComponent_div_0_Template(rf, ctx) {
  if (rf & 1) {
    _angular_core__WEBPACK_IMPORTED_MODULE_1__["ɵɵelementStart"](0, "div")(1, "h1");
    _angular_core__WEBPACK_IMPORTED_MODULE_1__["ɵɵtext"](2);
    _angular_core__WEBPACK_IMPORTED_MODULE_1__["ɵɵelementEnd"]();
    _angular_core__WEBPACK_IMPORTED_MODULE_1__["ɵɵelementStart"](3, "p");
    _angular_core__WEBPACK_IMPORTED_MODULE_1__["ɵɵtext"](4);
    _angular_core__WEBPACK_IMPORTED_MODULE_1__["ɵɵelementEnd"]()();
  }
  if (rf & 2) {
    const ctx_r0 = _angular_core__WEBPACK_IMPORTED_MODULE_1__["ɵɵnextContext"]();
    _angular_core__WEBPACK_IMPORTED_MODULE_1__["ɵɵadvance"](2);
    _angular_core__WEBPACK_IMPORTED_MODULE_1__["ɵɵtextInterpolate"](ctx_r0.galleryData.name);
    _angular_core__WEBPACK_IMPORTED_MODULE_1__["ɵɵadvance"](2);
    _angular_core__WEBPACK_IMPORTED_MODULE_1__["ɵɵtextInterpolate1"](" ", ctx_r0.galleryData.description, " ");
  }
}
class GalleryInfoComponent {
  constructor(store) {
    this.store = store;
  }
  ngOnInit() {
    this.store.select(_state_gallery_selector__WEBPACK_IMPORTED_MODULE_0__.getGalleryInfo).subscribe(data => {
      this.galleryData = data;
    });
  }
  static #_ = this.ɵfac = function GalleryInfoComponent_Factory(t) {
    return new (t || GalleryInfoComponent)(_angular_core__WEBPACK_IMPORTED_MODULE_1__["ɵɵdirectiveInject"](_ngrx_store__WEBPACK_IMPORTED_MODULE_2__.Store));
  };
  static #_2 = this.ɵcmp = /*@__PURE__*/_angular_core__WEBPACK_IMPORTED_MODULE_1__["ɵɵdefineComponent"]({
    type: GalleryInfoComponent,
    selectors: [["gallery-info"]],
    decls: 1,
    vars: 1,
    consts: [[4, "ngIf"]],
    template: function GalleryInfoComponent_Template(rf, ctx) {
      if (rf & 1) {
        _angular_core__WEBPACK_IMPORTED_MODULE_1__["ɵɵtemplate"](0, GalleryInfoComponent_div_0_Template, 5, 2, "div", 0);
      }
      if (rf & 2) {
        _angular_core__WEBPACK_IMPORTED_MODULE_1__["ɵɵproperty"]("ngIf", ctx.galleryData);
      }
    },
    dependencies: [_angular_common__WEBPACK_IMPORTED_MODULE_3__.NgIf],
    styles: ["\n/*# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbXSwibmFtZXMiOltdLCJtYXBwaW5ncyI6IiIsInNvdXJjZVJvb3QiOiIifQ== */"]
  });
}

/***/ }),

/***/ 8072:
/*!****************************************************************!*\
  !*** ./src/app/gallery/gallery-list/gallery-list.component.ts ***!
  \****************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "GalleryListComponent": () => (/* binding */ GalleryListComponent)
/* harmony export */ });
/* harmony import */ var _state_gallery_selector__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../state/gallery.selector */ 4806);
/* harmony import */ var _state_app_selector__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../../state/app.selector */ 6614);
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @angular/core */ 2560);
/* harmony import */ var _ngrx_store__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! @ngrx/store */ 3488);
/* harmony import */ var _angular_common__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! @angular/common */ 4666);
/* harmony import */ var _gallery_tile_gallery_tile_component__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../gallery-tile/gallery-tile.component */ 4511);






function GalleryListComponent_li_2_Template(rf, ctx) {
  if (rf & 1) {
    _angular_core__WEBPACK_IMPORTED_MODULE_3__["ɵɵelementStart"](0, "li", 3);
    _angular_core__WEBPACK_IMPORTED_MODULE_3__["ɵɵelement"](1, "gallery-tile", 4);
    _angular_core__WEBPACK_IMPORTED_MODULE_3__["ɵɵelementEnd"]();
  }
  if (rf & 2) {
    const gallery_r1 = ctx.$implicit;
    _angular_core__WEBPACK_IMPORTED_MODULE_3__["ɵɵadvance"](1);
    _angular_core__WEBPACK_IMPORTED_MODULE_3__["ɵɵproperty"]("gallery", gallery_r1);
  }
}
class GalleryListComponent {
  constructor(galleryStore, appStore) {
    this.galleryStore = galleryStore;
    this.appStore = appStore;
    this.galleryId = 0;
    this.galleries = [];
  }
  ngOnInit() {
    this.galleryStore.select(_state_gallery_selector__WEBPACK_IMPORTED_MODULE_0__.getGalleryId).subscribe(id => {
      this.galleryId = id;
      this.appStore.select((0,_state_app_selector__WEBPACK_IMPORTED_MODULE_1__.getSubGalleries)({
        id: this.galleryId
      })).subscribe(galleries => {
        this.galleries = galleries;
      });
    });
  }
  static #_ = this.ɵfac = function GalleryListComponent_Factory(t) {
    return new (t || GalleryListComponent)(_angular_core__WEBPACK_IMPORTED_MODULE_3__["ɵɵdirectiveInject"](_ngrx_store__WEBPACK_IMPORTED_MODULE_4__.Store), _angular_core__WEBPACK_IMPORTED_MODULE_3__["ɵɵdirectiveInject"](_ngrx_store__WEBPACK_IMPORTED_MODULE_4__.Store));
  };
  static #_2 = this.ɵcmp = /*@__PURE__*/_angular_core__WEBPACK_IMPORTED_MODULE_3__["ɵɵdefineComponent"]({
    type: GalleryListComponent,
    selectors: [["gallery-list"]],
    decls: 3,
    vars: 1,
    consts: [[1, "row"], [1, "list-unstyled"], ["class", "thumbnail col-md-3", "style", "min-height: 150px;", 4, "ngFor", "ngForOf"], [1, "thumbnail", "col-md-3", 2, "min-height", "150px"], [3, "gallery"]],
    template: function GalleryListComponent_Template(rf, ctx) {
      if (rf & 1) {
        _angular_core__WEBPACK_IMPORTED_MODULE_3__["ɵɵelementStart"](0, "div", 0)(1, "ul", 1);
        _angular_core__WEBPACK_IMPORTED_MODULE_3__["ɵɵtemplate"](2, GalleryListComponent_li_2_Template, 2, 1, "li", 2);
        _angular_core__WEBPACK_IMPORTED_MODULE_3__["ɵɵelementEnd"]()();
      }
      if (rf & 2) {
        _angular_core__WEBPACK_IMPORTED_MODULE_3__["ɵɵadvance"](2);
        _angular_core__WEBPACK_IMPORTED_MODULE_3__["ɵɵproperty"]("ngForOf", ctx.galleries);
      }
    },
    dependencies: [_angular_common__WEBPACK_IMPORTED_MODULE_5__.NgForOf, _gallery_tile_gallery_tile_component__WEBPACK_IMPORTED_MODULE_2__.GalleryTileComponent],
    styles: [".thumbnail[_ngcontent-%COMP%] {\n    height: 250px;\n}\n/*# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8uL3NyYy9hcHAvZ2FsbGVyeS9nYWxsZXJ5LWxpc3QvZ2FsbGVyeS1saXN0LmNvbXBvbmVudC5jc3MiXSwibmFtZXMiOltdLCJtYXBwaW5ncyI6IkFBQUE7SUFDSSxhQUFhO0FBQ2pCIiwic291cmNlc0NvbnRlbnQiOlsiLnRodW1ibmFpbCB7XG4gICAgaGVpZ2h0OiAyNTBweDtcbn0iXSwic291cmNlUm9vdCI6IiJ9 */"]
  });
}

/***/ }),

/***/ 4511:
/*!****************************************************************!*\
  !*** ./src/app/gallery/gallery-tile/gallery-tile.component.ts ***!
  \****************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "GalleryTileComponent": () => (/* binding */ GalleryTileComponent)
/* harmony export */ });
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @angular/core */ 2560);
/* harmony import */ var _angular_common__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @angular/common */ 4666);
/* harmony import */ var _angular_router__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @angular/router */ 124);



function GalleryTileComponent_img_1_Template(rf, ctx) {
  if (rf & 1) {
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelement"](0, "img", 3);
  }
}
function GalleryTileComponent_img_2_Template(rf, ctx) {
  if (rf & 1) {
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelement"](0, "img", 4);
  }
  if (rf & 2) {
    const ctx_r1 = _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵnextContext"]();
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵpropertyInterpolate1"]("src", "/image/thumb/", ctx_r1.gallery.thumbId, ".jpg", _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵsanitizeUrl"]);
  }
}
const _c0 = function (a0) {
  return [a0];
};
class GalleryTileComponent {
  constructor() {}
  getLink(id) {
    return '/gallery/' + this.gallery.id;
  }
  doesThumbExist(thumbId) {
    return thumbId !== null;
  }
  static #_ = this.ɵfac = function GalleryTileComponent_Factory(t) {
    return new (t || GalleryTileComponent)();
  };
  static #_2 = this.ɵcmp = /*@__PURE__*/_angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵdefineComponent"]({
    type: GalleryTileComponent,
    selectors: [["gallery-tile"]],
    inputs: {
      gallery: "gallery"
    },
    decls: 5,
    vars: 6,
    consts: [[3, "routerLink"], ["src", "http://placehold.it/300x200", 4, "ngIf"], [3, "src", 4, "ngIf"], ["src", "http://placehold.it/300x200"], [3, "src"]],
    template: function GalleryTileComponent_Template(rf, ctx) {
      if (rf & 1) {
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementStart"](0, "a", 0);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵtemplate"](1, GalleryTileComponent_img_1_Template, 1, 0, "img", 1);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵtemplate"](2, GalleryTileComponent_img_2_Template, 1, 1, "img", 2);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementStart"](3, "h4");
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵtext"](4);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementEnd"]()();
      }
      if (rf & 2) {
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵproperty"]("routerLink", _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵpureFunction1"](4, _c0, ctx.getLink(ctx.gallery.id)));
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵadvance"](1);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵproperty"]("ngIf", !ctx.doesThumbExist(ctx.gallery.thumbId));
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵadvance"](1);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵproperty"]("ngIf", ctx.doesThumbExist(ctx.gallery.thumbId));
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵadvance"](2);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵtextInterpolate"](ctx.gallery.name);
      }
    },
    dependencies: [_angular_common__WEBPACK_IMPORTED_MODULE_1__.NgIf, _angular_router__WEBPACK_IMPORTED_MODULE_2__.RouterLink],
    styles: ["\n/*# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbXSwibmFtZXMiOltdLCJtYXBwaW5ncyI6IiIsInNvdXJjZVJvb3QiOiIifQ== */"]
  });
}

/***/ }),

/***/ 5923:
/*!**********************************************************************!*\
  !*** ./src/app/gallery/gallery-toolbar/gallery-toolbar.component.ts ***!
  \**********************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "GalleryToolbarComponent": () => (/* binding */ GalleryToolbarComponent)
/* harmony export */ });
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @angular/core */ 2560);
/* harmony import */ var _angular_router__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @angular/router */ 124);
/* harmony import */ var _gallery_edit_gallery_edit_component__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../gallery-edit/gallery-edit.component */ 9188);
/* harmony import */ var _image_image_add_image_add_component__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../../image/image-add/image-add.component */ 1963);




class GalleryToolbarComponent {
  constructor(router) {
    this.router = router;
  }
  ngOnInit() {}
  onEditClick() {
    //this.buttonClickService.trigger('galleryEditClick');
  }
  onAddGalleryClick() {
    //this.buttonClickService.trigger('galleryAddClick');
  }
  onAddImageClick() {
    //this.buttonClickService.trigger('imageAddClick');
  }
  onDeleteClick() {
    if (confirm('Delete this gallery?')) {
      /*this.galleryService.delete(this.gallery)
          .pipe(
              tap(gallery => {
                  let options =
                      {
                          message: 'Gallery deleted',
                          container: '#editSuccessContainer',
                          duration: 5000
                      };
                  $.meow(options);
                   if (this.gallery.parentId > 0)
                      this.router.navigate(['/gallery/' + this.gallery.parentId]);
                  else
                      this.router.navigate(['/']);
              })
          );*/
    }
  }
  static #_ = this.ɵfac = function GalleryToolbarComponent_Factory(t) {
    return new (t || GalleryToolbarComponent)(_angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵdirectiveInject"](_angular_router__WEBPACK_IMPORTED_MODULE_3__.Router));
  };
  static #_2 = this.ɵcmp = /*@__PURE__*/_angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵdefineComponent"]({
    type: GalleryToolbarComponent,
    selectors: [["gallery-toolbar"]],
    inputs: {
      gallery: "gallery"
    },
    decls: 13,
    vars: 2,
    consts: [[3, "gallery"], [1, "row"], [1, "pull-right"], ["role", "group", "aria-label", "...", 1, "btn-group"], ["type", "button", "id", "galleryAdd", "title", "Add gallery", "data-toggle", "tooltip", 1, "btn", "btn-default", 3, "click"], [1, "glyphicon", "glyphicon-th"], ["type", "button", "id", "imageAdd", "title", "Add image", "data-toggle", "tooltip", 1, "btn", "btn-default", 3, "click"], [1, "glyphicon", "glyphicon-picture"], ["type", "button", "id", "galleryEdit", "title", "Edit gallery", "data-toggle", "tooltip", 1, "btn", "btn-default", 3, "click"], [1, "glyphicon", "glyphicon-pencil"], ["type", "button", "id", "galleryDelete", "title", "Delete gallery", "data-toggle", "tooltip", 1, "btn", "btn-default", 3, "click"], [1, "glyphicon", "glyphicon-trash"]],
    template: function GalleryToolbarComponent_Template(rf, ctx) {
      if (rf & 1) {
        _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵelement"](0, "gallery-edit", 0)(1, "image-add", 0);
        _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵelementStart"](2, "div", 1)(3, "div", 2)(4, "div", 3)(5, "button", 4);
        _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵlistener"]("click", function GalleryToolbarComponent_Template_button_click_5_listener() {
          return ctx.onAddGalleryClick();
        });
        _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵelement"](6, "span", 5);
        _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵelementEnd"]();
        _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵelementStart"](7, "button", 6);
        _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵlistener"]("click", function GalleryToolbarComponent_Template_button_click_7_listener() {
          return ctx.onAddImageClick();
        });
        _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵelement"](8, "span", 7);
        _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵelementEnd"]();
        _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵelementStart"](9, "button", 8);
        _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵlistener"]("click", function GalleryToolbarComponent_Template_button_click_9_listener() {
          return ctx.onEditClick();
        });
        _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵelement"](10, "span", 9);
        _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵelementEnd"]();
        _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵelementStart"](11, "button", 10);
        _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵlistener"]("click", function GalleryToolbarComponent_Template_button_click_11_listener() {
          return ctx.onDeleteClick();
        });
        _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵelement"](12, "span", 11);
        _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵelementEnd"]()()()();
      }
      if (rf & 2) {
        _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵproperty"]("gallery", ctx.gallery);
        _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵadvance"](1);
        _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵproperty"]("gallery", ctx.gallery);
      }
    },
    dependencies: [_gallery_edit_gallery_edit_component__WEBPACK_IMPORTED_MODULE_0__.GalleryEditComponent, _image_image_add_image_add_component__WEBPACK_IMPORTED_MODULE_1__.ImageAddComponent],
    styles: ["\n/*# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbXSwibmFtZXMiOltdLCJtYXBwaW5ncyI6IiIsInNvdXJjZVJvb3QiOiIifQ== */"]
  });
}

/***/ }),

/***/ 8632:
/*!*******************************************!*\
  !*** ./src/app/gallery/gallery.module.ts ***!
  \*******************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "GalleryModule": () => (/* binding */ GalleryModule)
/* harmony export */ });
/* harmony import */ var _angular_common__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @angular/common */ 4666);
/* harmony import */ var _ngrx_store__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! @ngrx/store */ 3488);
/* harmony import */ var _state_gallery_reducer__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./state/gallery.reducer */ 8630);
/* harmony import */ var _ngrx_effects__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! @ngrx/effects */ 5405);
/* harmony import */ var _state_gallery_effect__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./state/gallery.effect */ 59);
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @angular/core */ 2560);








class GalleryModule {
  static #_ = this.ɵfac = function GalleryModule_Factory(t) {
    return new (t || GalleryModule)();
  };
  static #_2 = this.ɵmod = /*@__PURE__*/_angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵdefineNgModule"]({
    type: GalleryModule
  });
  static #_3 = this.ɵinj = /*@__PURE__*/_angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵdefineInjector"]({
    imports: [_angular_common__WEBPACK_IMPORTED_MODULE_3__.CommonModule, _ngrx_store__WEBPACK_IMPORTED_MODULE_4__.StoreModule.forFeature('gallery', _state_gallery_reducer__WEBPACK_IMPORTED_MODULE_0__.galleryReducer), _ngrx_effects__WEBPACK_IMPORTED_MODULE_5__.EffectsModule.forFeature([_state_gallery_effect__WEBPACK_IMPORTED_MODULE_1__.GalleryEffect])]
  });
}
(function () {
  (typeof ngJitMode === "undefined" || ngJitMode) && _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵsetNgModuleScope"](GalleryModule, {
    imports: [_angular_common__WEBPACK_IMPORTED_MODULE_3__.CommonModule, _ngrx_store__WEBPACK_IMPORTED_MODULE_4__.StoreFeatureModule, _ngrx_effects__WEBPACK_IMPORTED_MODULE_5__.EffectsFeatureModule]
  });
})();

/***/ }),

/***/ 8422:
/*!********************************************!*\
  !*** ./src/app/gallery/gallery.service.ts ***!
  \********************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "GalleryService": () => (/* binding */ GalleryService)
/* harmony export */ });
/* harmony import */ var rxjs__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! rxjs */ 6587);
/* harmony import */ var rxjs_operators__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! rxjs/operators */ 7418);
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @angular/core */ 2560);
/* harmony import */ var _angular_common_http__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @angular/common/http */ 8987);




class GalleryService {
  constructor(http) {
    this.http = http;
    this.api_url = '/api/gallery/';
  }
  get gallery() {
    return this._gallery;
  }
  handleError(err) {
    // in a real world app, we may send the server to some remote logging infrastructure
    // instead of just logging it to the console
    let errorMessage;
    if (err.error instanceof ErrorEvent) {
      // A client-side or network error occurred. Handle it accordingly.
      errorMessage = `An error occurred: ${err.error.message}`;
    } else {
      // The backend returned an unsuccessful response code.
      // The response body may contain clues as to what went wrong,
      errorMessage = `Backend returned code ${err.status}: ${err.body.error}`;
    }
    console.error(err);
    return (0,rxjs__WEBPACK_IMPORTED_MODULE_0__.throwError)(errorMessage);
  }
  getGallery(id) {
    return this.http.get(this.api_url + id).pipe( /*tap(data => console.log(JSON.stringify(data))),*/
    (0,rxjs_operators__WEBPACK_IMPORTED_MODULE_1__.catchError)(this.handleError));
  }
  static #_ = this.ɵfac = function GalleryService_Factory(t) {
    return new (t || GalleryService)(_angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵinject"](_angular_common_http__WEBPACK_IMPORTED_MODULE_3__.HttpClient));
  };
  static #_2 = this.ɵprov = /*@__PURE__*/_angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵdefineInjectable"]({
    token: GalleryService,
    factory: GalleryService.ɵfac
  });
}

/***/ }),

/***/ 2868:
/*!*************************************************!*\
  !*** ./src/app/gallery/state/gallery.action.ts ***!
  \*************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "galleryLoadedAction": () => (/* binding */ galleryLoadedAction),
/* harmony export */   "loadGalleryAction": () => (/* binding */ loadGalleryAction)
/* harmony export */ });
/* harmony import */ var _ngrx_store__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @ngrx/store */ 3488);

const loadGalleryAction = (0,_ngrx_store__WEBPACK_IMPORTED_MODULE_0__.createAction)('[Gallery] Load gallery', (0,_ngrx_store__WEBPACK_IMPORTED_MODULE_0__.props)());
const galleryLoadedAction = (0,_ngrx_store__WEBPACK_IMPORTED_MODULE_0__.createAction)('[Gallery] Gallery loaded', (0,_ngrx_store__WEBPACK_IMPORTED_MODULE_0__.props)());

/***/ }),

/***/ 59:
/*!*************************************************!*\
  !*** ./src/app/gallery/state/gallery.effect.ts ***!
  \*************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "GalleryEffect": () => (/* binding */ GalleryEffect)
/* harmony export */ });
/* harmony import */ var _ngrx_effects__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @ngrx/effects */ 5405);
/* harmony import */ var _gallery_action__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./gallery.action */ 2868);
/* harmony import */ var rxjs_operators__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! rxjs/operators */ 522);
/* harmony import */ var rxjs_operators__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! rxjs/operators */ 6942);
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! @angular/core */ 2560);
/* harmony import */ var _gallery_service__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../gallery.service */ 8422);






class GalleryEffect {
  constructor(actions$, galleryService) {
    this.actions$ = actions$;
    this.galleryService = galleryService;
    this.loadGalleryInfo$ = (0,_ngrx_effects__WEBPACK_IMPORTED_MODULE_2__.createEffect)(() => {
      return this.actions$.pipe((0,_ngrx_effects__WEBPACK_IMPORTED_MODULE_2__.ofType)(_gallery_action__WEBPACK_IMPORTED_MODULE_0__.loadGalleryAction), (0,rxjs_operators__WEBPACK_IMPORTED_MODULE_3__.mergeMap)(data => {
        return this.galleryService.getGallery(data.id).pipe((0,rxjs_operators__WEBPACK_IMPORTED_MODULE_4__.map)(gallery => {
          return _gallery_action__WEBPACK_IMPORTED_MODULE_0__.galleryLoadedAction({
            gallery: gallery
          });
        }));
      }));
    });
  }
  static #_ = this.ɵfac = function GalleryEffect_Factory(t) {
    return new (t || GalleryEffect)(_angular_core__WEBPACK_IMPORTED_MODULE_5__["ɵɵinject"](_ngrx_effects__WEBPACK_IMPORTED_MODULE_2__.Actions), _angular_core__WEBPACK_IMPORTED_MODULE_5__["ɵɵinject"](_gallery_service__WEBPACK_IMPORTED_MODULE_1__.GalleryService));
  };
  static #_2 = this.ɵprov = /*@__PURE__*/_angular_core__WEBPACK_IMPORTED_MODULE_5__["ɵɵdefineInjectable"]({
    token: GalleryEffect,
    factory: GalleryEffect.ɵfac
  });
}

/***/ }),

/***/ 8630:
/*!**************************************************!*\
  !*** ./src/app/gallery/state/gallery.reducer.ts ***!
  \**************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "galleryReducer": () => (/* binding */ galleryReducer)
/* harmony export */ });
/* harmony import */ var _ngrx_store__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @ngrx/store */ 3488);
/* harmony import */ var _gallery_action__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./gallery.action */ 2868);


const initialState = {
  gallery: {
    id: 0,
    name: '',
    thumbId: 0,
    parentId: 0,
    parentGalleryId: 0,
    tagIdList: [],
    description: '',
    useTags: true,
    combinedView: false
  }
};
const galleryReducer = (0,_ngrx_store__WEBPACK_IMPORTED_MODULE_1__.createReducer)(initialState, (0,_ngrx_store__WEBPACK_IMPORTED_MODULE_1__.on)(_gallery_action__WEBPACK_IMPORTED_MODULE_0__.galleryLoadedAction, (state, data) => {
  var val = {
    gallery: {
      ...state.gallery
    }
  };
  val.gallery = {
    ...data.gallery
  };
  return val;
}));

/***/ }),

/***/ 4806:
/*!***************************************************!*\
  !*** ./src/app/gallery/state/gallery.selector.ts ***!
  \***************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "getGalleryId": () => (/* binding */ getGalleryId),
/* harmony export */   "getGalleryInfo": () => (/* binding */ getGalleryInfo)
/* harmony export */ });
/* harmony import */ var _ngrx_store__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @ngrx/store */ 3488);

const getGalleryFeatureSelector = (0,_ngrx_store__WEBPACK_IMPORTED_MODULE_0__.createFeatureSelector)('gallery');
const EmptyGalleryInfo = {
  name: '',
  description: ''
};
const getGalleryInfo = (0,_ngrx_store__WEBPACK_IMPORTED_MODULE_0__.createSelector)(getGalleryFeatureSelector, state => {
  let data = EmptyGalleryInfo;
  data.name = state.gallery.name;
  data.description = state.gallery.description;
  return data;
});
const getGalleryId = (0,_ngrx_store__WEBPACK_IMPORTED_MODULE_0__.createSelector)(getGalleryFeatureSelector, state => {
  return state.gallery.id;
});

/***/ }),

/***/ 5434:
/*!*************************************************************!*\
  !*** ./src/app/home/home-toolbar/home-toolbar.component.ts ***!
  \*************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "HomeToolbarComponent": () => (/* binding */ HomeToolbarComponent)
/* harmony export */ });
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @angular/core */ 2560);
/* harmony import */ var _services_data_service__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../../services/data.service */ 2468);
/* harmony import */ var _services_button_click_service__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../../services/button-click.service */ 4872);
/* harmony import */ var _angular_router__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! @angular/router */ 124);
/* harmony import */ var _gallery_gallery_edit_gallery_edit_component__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../gallery/gallery-edit/gallery-edit.component */ 9188);





class HomeToolbarComponent {
  constructor(dataService, buttonClickService, router) {
    this.dataService = dataService;
    this.buttonClickService = buttonClickService;
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
  static #_ = this.ɵfac = function HomeToolbarComponent_Factory(t) {
    return new (t || HomeToolbarComponent)(_angular_core__WEBPACK_IMPORTED_MODULE_3__["ɵɵdirectiveInject"](_services_data_service__WEBPACK_IMPORTED_MODULE_0__.DataService), _angular_core__WEBPACK_IMPORTED_MODULE_3__["ɵɵdirectiveInject"](_services_button_click_service__WEBPACK_IMPORTED_MODULE_1__.ButtonClickService), _angular_core__WEBPACK_IMPORTED_MODULE_3__["ɵɵdirectiveInject"](_angular_router__WEBPACK_IMPORTED_MODULE_4__.Router));
  };
  static #_2 = this.ɵcmp = /*@__PURE__*/_angular_core__WEBPACK_IMPORTED_MODULE_3__["ɵɵdefineComponent"]({
    type: HomeToolbarComponent,
    selectors: [["home-toolbar"]],
    decls: 6,
    vars: 1,
    consts: [[3, "gallery"], [1, "row"], [1, "pull-right"], ["role", "group", "aria-label", "...", 1, "btn-group"], ["type", "button", "id", "galleryAdd", "title", "Add gallery", "data-toggle", "tooltip", 1, "btn", "btn-default", 3, "click"], [1, "glyphicon", "glyphicon-th"]],
    template: function HomeToolbarComponent_Template(rf, ctx) {
      if (rf & 1) {
        _angular_core__WEBPACK_IMPORTED_MODULE_3__["ɵɵelement"](0, "gallery-edit", 0);
        _angular_core__WEBPACK_IMPORTED_MODULE_3__["ɵɵelementStart"](1, "div", 1)(2, "div", 2)(3, "div", 3)(4, "button", 4);
        _angular_core__WEBPACK_IMPORTED_MODULE_3__["ɵɵlistener"]("click", function HomeToolbarComponent_Template_button_click_4_listener() {
          return ctx.onAddGalleryClick();
        });
        _angular_core__WEBPACK_IMPORTED_MODULE_3__["ɵɵelement"](5, "span", 5);
        _angular_core__WEBPACK_IMPORTED_MODULE_3__["ɵɵelementEnd"]()()()();
      }
      if (rf & 2) {
        _angular_core__WEBPACK_IMPORTED_MODULE_3__["ɵɵproperty"]("gallery", ctx.gallery);
      }
    },
    dependencies: [_gallery_gallery_edit_gallery_edit_component__WEBPACK_IMPORTED_MODULE_2__.GalleryEditComponent],
    styles: ["\n/*# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbXSwibmFtZXMiOltdLCJtYXBwaW5ncyI6IiIsInNvdXJjZVJvb3QiOiIifQ== */"]
  });
}

/***/ }),

/***/ 1963:
/*!********************************************************!*\
  !*** ./src/app/image/image-add/image-add.component.ts ***!
  \********************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "ImageAddComponent": () => (/* binding */ ImageAddComponent)
/* harmony export */ });
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @angular/core */ 2560);
/* harmony import */ var _services_button_click_service__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../../services/button-click.service */ 4872);
/* harmony import */ var _image_service__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../image.service */ 964);
/* harmony import */ var _angular_router__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @angular/router */ 124);
/* harmony import */ var _angular_common__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! @angular/common */ 4666);
/* harmony import */ var _angular_forms__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! @angular/forms */ 2508);
/* harmony import */ var primeng_fileupload__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! primeng/fileupload */ 6193);
/* harmony import */ var primeng_api__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(/*! primeng/api */ 4356);








function ImageAddComponent_option_21_Template(rf, ctx) {
  if (rf & 1) {
    _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵelementStart"](0, "option", 21);
    _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵtext"](1);
    _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵelementEnd"]();
  }
  if (rf & 2) {
    const tag_r2 = ctx.$implicit;
    _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵpropertyInterpolate"]("value", tag_r2.id);
    _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵadvance"](1);
    _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵtextInterpolate"](tag_r2.name);
  }
}
function ImageAddComponent_ng_template_27_ul_0_li_1_Template(rf, ctx) {
  if (rf & 1) {
    const _r7 = _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵgetCurrentView"]();
    _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵelementStart"](0, "li");
    _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵelement"](1, "img", 25);
    _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵtext"](2);
    _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵelementStart"](3, "a", 26);
    _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵlistener"]("click", function ImageAddComponent_ng_template_27_ul_0_li_1_Template_a_click_3_listener($event) {
      const restoredCtx = _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵrestoreView"](_r7);
      const file_r5 = restoredCtx.$implicit;
      const ctx_r6 = _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵnextContext"](3);
      return _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵresetView"](ctx_r6.fileDelete($event, file_r5));
    });
    _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵelement"](4, "span", 27);
    _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵelementEnd"]()();
  }
  if (rf & 2) {
    const file_r5 = ctx.$implicit;
    _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵadvance"](1);
    _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵpropertyInterpolate1"]("src", "/image/uploaded/", file_r5.hash, "", _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵsanitizeUrl"]);
    _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵadvance"](1);
    _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵtextInterpolate2"](" ", file_r5.name, " - ", file_r5.size, " bytes ");
  }
}
function ImageAddComponent_ng_template_27_ul_0_Template(rf, ctx) {
  if (rf & 1) {
    _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵelementStart"](0, "ul", 23);
    _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵtemplate"](1, ImageAddComponent_ng_template_27_ul_0_li_1_Template, 5, 3, "li", 24);
    _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵelementEnd"]();
  }
  if (rf & 2) {
    const ctx_r3 = _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵnextContext"](2);
    _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵadvance"](1);
    _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵproperty"]("ngForOf", ctx_r3.uploadedFiles);
  }
}
function ImageAddComponent_ng_template_27_Template(rf, ctx) {
  if (rf & 1) {
    _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵtemplate"](0, ImageAddComponent_ng_template_27_ul_0_Template, 2, 1, "ul", 22);
  }
  if (rf & 2) {
    const ctx_r1 = _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵnextContext"]();
    _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵproperty"]("ngIf", ctx_r1.uploadedFiles.length);
  }
}
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
      if (data.name !== 'imageAddClick') return;
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
      this.tagList.push({
        name: tag.name,
        id: '' + tag.id
      });
    }
  }
  onSubmit() {
    // Select2 isn't synchronising so we have to get the selections manually
    let tagData = $('#inputImageTags').select2('data');
    let tags = [];
    for (let tag of tagData) {
      tags.push(tag.id);
    }
    let files = this.uploadedFiles.map(file => {
      return file.hash;
    });
    /*this.imageService.SubmitImages({
        id: 0,
        gallery_id: this.gallery.id,
        description: this.description,
        tags: tags,
        fileHashes: files
    }).subscribe(data => {
        let options =
            {
                message: 'Image saved',
                container: '#editSuccessContainer',
                duration: 5000
            };
        $.meow(options);
        $('#inputImageTags').children().remove();
        $('#add-modal').modal('hide');
         if (files.length === 1)
            this.router.navigate(['/image/' + this.gallery.id + '/' + data.message]);
    });*/
  }

  ngOnInit() {}
  onUpload(event) {
    let response = JSON.parse(event.xhr.response);
    for (let file of event.files) {
      let hash = '';
      for (let r of response) {
        if (r.filename === file.name) hash = r.hash;
      }
      file.hash = hash;
      this.uploadedFiles.push(file);
    }
  }
  fileDelete($event, file) {
    $event.preventDefault();
    console.log(file);
    let fileIndex = -1;
    for (let {
      item,
      index
    } of this.uploadedFiles.map((item, index) => ({
      item,
      index
    }))) {
      if (item.hash === file.hash) fileIndex = index;
    }
    if (fileIndex > -1) this.uploadedFiles.splice(fileIndex, 1);
  }
  static #_ = this.ɵfac = function ImageAddComponent_Factory(t) {
    return new (t || ImageAddComponent)(_angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵdirectiveInject"](_services_button_click_service__WEBPACK_IMPORTED_MODULE_0__.ButtonClickService), _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵdirectiveInject"](_image_service__WEBPACK_IMPORTED_MODULE_1__.ImageService), _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵdirectiveInject"](_angular_router__WEBPACK_IMPORTED_MODULE_3__.Router));
  };
  static #_2 = this.ɵcmp = /*@__PURE__*/_angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵdefineComponent"]({
    type: ImageAddComponent,
    selectors: [["image-add"]],
    inputs: {
      gallery: "gallery"
    },
    decls: 32,
    vars: 2,
    consts: [["id", "add-modal", 1, "modal", "fade"], [1, "modal-dialog"], [1, "modal-content"], [1, "modal-header"], ["type", "button", "data-dismiss", "modal", "aria-label", "Close", 1, "close"], ["aria-hidden", "true"], [1, "modal-title"], ["action", "", "method", "post", 1, "form-horizontal"], [1, "modal-body"], [1, "form-group"], ["for", "inputImageDescription", 1, "col-sm-2", "control-label"], [1, "col-sm-10"], ["name", "inputImageDescription", "id", "inputImageDescription", "placeholder", "Edit...", 1, "form-control", 3, "ngModel", "ngModelChange"], ["for", "inputImageTags", 1, "col-sm-2", "control-label"], ["name", "inputImageTags[]", "id", "inputImageTags", "multiple", "", 1, "form-control", 2, "width", "100%"], ["selected", "selected", 3, "value", 4, "ngFor", "ngForOf"], ["url", "/api/upload", "name", "myfile[]", "accept", "image/*", "auto", "auto", "multiple", "multiple", 3, "onUpload"], ["pTemplate", "content"], [1, "modal-footer"], ["type", "button", "data-dismiss", "modal", 1, "btn", "btn-default"], ["type", "submit", "value", "Save changes", 1, "btn", "btn-primary", 3, "click"], ["selected", "selected", 3, "value"], ["class", "list-unstyled uploaded-image-list", 4, "ngIf"], [1, "list-unstyled", "uploaded-image-list"], [4, "ngFor", "ngForOf"], ["width", "50", 3, "src"], ["href", "#", 3, "click"], [1, "glyphicon", "glyphicon-trash"]],
    template: function ImageAddComponent_Template(rf, ctx) {
      if (rf & 1) {
        _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵelementStart"](0, "div", 0)(1, "div", 1)(2, "div", 2)(3, "div", 3)(4, "button", 4)(5, "span", 5);
        _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵtext"](6, "\u00D7");
        _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵelementEnd"]()();
        _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵelementStart"](7, "h4", 6);
        _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵtext"](8, "Add image");
        _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵelementEnd"]()();
        _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵelementStart"](9, "form", 7)(10, "div", 8)(11, "div", 9)(12, "label", 10);
        _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵtext"](13, "Description");
        _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵelementEnd"]();
        _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵelementStart"](14, "div", 11)(15, "textarea", 12);
        _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵlistener"]("ngModelChange", function ImageAddComponent_Template_textarea_ngModelChange_15_listener($event) {
          return ctx.description = $event;
        });
        _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵelementEnd"]()()();
        _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵelementStart"](16, "div", 9)(17, "label", 13);
        _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵtext"](18, "Tags");
        _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵelementEnd"]();
        _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵelementStart"](19, "div", 11)(20, "select", 14);
        _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵtemplate"](21, ImageAddComponent_option_21_Template, 2, 2, "option", 15);
        _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵelementEnd"]()()();
        _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵelementStart"](22, "div", 9)(23, "label", 13);
        _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵtext"](24, "Image");
        _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵelementEnd"]();
        _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵelementStart"](25, "div", 11)(26, "p-fileUpload", 16);
        _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵlistener"]("onUpload", function ImageAddComponent_Template_p_fileUpload_onUpload_26_listener($event) {
          return ctx.onUpload($event);
        });
        _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵtemplate"](27, ImageAddComponent_ng_template_27_Template, 1, 1, "ng-template", 17);
        _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵelementEnd"]()()()();
        _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵelementStart"](28, "div", 18)(29, "button", 19);
        _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵtext"](30, "Close");
        _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵelementEnd"]();
        _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵelementStart"](31, "input", 20);
        _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵlistener"]("click", function ImageAddComponent_Template_input_click_31_listener() {
          return ctx.onSubmit();
        });
        _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵelementEnd"]()()()()()();
      }
      if (rf & 2) {
        _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵadvance"](15);
        _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵproperty"]("ngModel", ctx.description);
        _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵadvance"](6);
        _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵproperty"]("ngForOf", ctx.tagList);
      }
    },
    dependencies: [_angular_common__WEBPACK_IMPORTED_MODULE_4__.NgForOf, _angular_common__WEBPACK_IMPORTED_MODULE_4__.NgIf, _angular_forms__WEBPACK_IMPORTED_MODULE_5__["ɵNgNoValidate"], _angular_forms__WEBPACK_IMPORTED_MODULE_5__.NgSelectOption, _angular_forms__WEBPACK_IMPORTED_MODULE_5__["ɵNgSelectMultipleOption"], _angular_forms__WEBPACK_IMPORTED_MODULE_5__.DefaultValueAccessor, _angular_forms__WEBPACK_IMPORTED_MODULE_5__.NgControlStatus, _angular_forms__WEBPACK_IMPORTED_MODULE_5__.NgControlStatusGroup, _angular_forms__WEBPACK_IMPORTED_MODULE_5__.NgModel, _angular_forms__WEBPACK_IMPORTED_MODULE_5__.NgForm, primeng_fileupload__WEBPACK_IMPORTED_MODULE_6__.FileUpload, primeng_api__WEBPACK_IMPORTED_MODULE_7__.PrimeTemplate],
    styles: [".uploaded-image-list[_ngcontent-%COMP%]   li[_ngcontent-%COMP%] {\n    padding: 5px 10px;\n}\n\n.uploaded-image-list[_ngcontent-%COMP%]   li[_ngcontent-%COMP%]   img[_ngcontent-%COMP%] {\n    padding-right: 10px;\n}\n/*# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8uL3NyYy9hcHAvaW1hZ2UvaW1hZ2UtYWRkL2ltYWdlLWFkZC5jb21wb25lbnQuY3NzIl0sIm5hbWVzIjpbXSwibWFwcGluZ3MiOiJBQUFBO0lBQ0ksaUJBQWlCO0FBQ3JCOztBQUVBO0lBQ0ksbUJBQW1CO0FBQ3ZCIiwic291cmNlc0NvbnRlbnQiOlsiLnVwbG9hZGVkLWltYWdlLWxpc3QgbGkge1xuICAgIHBhZGRpbmc6IDVweCAxMHB4O1xufVxuXG4udXBsb2FkZWQtaW1hZ2UtbGlzdCBsaSBpbWcge1xuICAgIHBhZGRpbmctcmlnaHQ6IDEwcHg7XG59Il0sInNvdXJjZVJvb3QiOiIifQ== */"]
  });
}

/***/ }),

/***/ 6424:
/*!**********************************************************!*\
  !*** ./src/app/image/image-edit/image-edit.component.ts ***!
  \**********************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "ImageEditComponent": () => (/* binding */ ImageEditComponent)
/* harmony export */ });
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @angular/core */ 2560);
/* harmony import */ var _services_button_click_service__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../../services/button-click.service */ 4872);
/* harmony import */ var _image_service__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../image.service */ 964);
/* harmony import */ var _angular_router__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @angular/router */ 124);
/* harmony import */ var _angular_common__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! @angular/common */ 4666);
/* harmony import */ var _angular_forms__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! @angular/forms */ 2508);






function ImageEditComponent_option_21_Template(rf, ctx) {
  if (rf & 1) {
    _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵelementStart"](0, "option", 19);
    _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵtext"](1);
    _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵelementEnd"]();
  }
  if (rf & 2) {
    const tag_r1 = ctx.$implicit;
    _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵpropertyInterpolate"]("value", tag_r1.id);
    _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵadvance"](1);
    _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵtextInterpolate"](tag_r1.name);
  }
}
class ImageEditComponent {
  constructor(buttonClickService, imageService, router) {
    this.buttonClickService = buttonClickService;
    this.imageService = imageService;
    this.router = router;
    this.id = '0';
    this.tagList = [];
    this.description = '';
    this.subscription = this.buttonClickService.notifyObservable$.subscribe(data => {
      if (data.name !== 'imageEditClick') return;
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
      this.tagList.push({
        name: tag.name,
        id: '' + tag.id
      });
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
    /*this.imageService.SubmitImages({
        id: this.image.id,
        gallery_id: this.image.gallery_id,
        description: this.description,
        tags: tags,
    }).subscribe(data => {
        let options =
            {
                message: 'Image saved',
                container: '#editSuccessContainer',
                duration: 5000
            };
        $.meow(options);
        $('#inputImageTags').children().remove();
        $('#edit-modal').modal('hide');
    });*/
  }

  ngOnInit() {}
  static #_ = this.ɵfac = function ImageEditComponent_Factory(t) {
    return new (t || ImageEditComponent)(_angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵdirectiveInject"](_services_button_click_service__WEBPACK_IMPORTED_MODULE_0__.ButtonClickService), _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵdirectiveInject"](_image_service__WEBPACK_IMPORTED_MODULE_1__.ImageService), _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵdirectiveInject"](_angular_router__WEBPACK_IMPORTED_MODULE_3__.Router));
  };
  static #_2 = this.ɵcmp = /*@__PURE__*/_angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵdefineComponent"]({
    type: ImageEditComponent,
    selectors: [["image-edit"]],
    inputs: {
      image: "image"
    },
    decls: 26,
    vars: 2,
    consts: [["id", "edit-modal", 1, "modal", "fade"], [1, "modal-dialog"], [1, "modal-content"], [1, "modal-header"], ["type", "button", "data-dismiss", "modal", "aria-label", "Close", 1, "close"], ["aria-hidden", "true"], [1, "modal-title"], ["action", "", "method", "post", 1, "form-horizontal"], [1, "modal-body"], [1, "form-group"], ["for", "inputImageDescription", 1, "col-sm-2", "control-label"], [1, "col-sm-10"], ["name", "inputImageDescription", "id", "inputImageDescription", "placeholder", "Edit...", 1, "form-control", 3, "ngModel", "ngModelChange"], ["for", "inputImageTags", 1, "col-sm-2", "control-label"], ["name", "inputImageTags[]", "id", "inputImageTags", "multiple", "", 1, "form-control", 2, "width", "100%"], ["selected", "selected", 3, "value", 4, "ngFor", "ngForOf"], [1, "modal-footer"], ["type", "button", "data-dismiss", "modal", 1, "btn", "btn-default"], ["type", "submit", "value", "Save changes", 1, "btn", "btn-primary", 3, "click"], ["selected", "selected", 3, "value"]],
    template: function ImageEditComponent_Template(rf, ctx) {
      if (rf & 1) {
        _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵelementStart"](0, "div", 0)(1, "div", 1)(2, "div", 2)(3, "div", 3)(4, "button", 4)(5, "span", 5);
        _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵtext"](6, "\u00D7");
        _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵelementEnd"]()();
        _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵelementStart"](7, "h4", 6);
        _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵtext"](8, "Edit image");
        _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵelementEnd"]()();
        _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵelementStart"](9, "form", 7)(10, "div", 8)(11, "div", 9)(12, "label", 10);
        _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵtext"](13, "Description");
        _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵelementEnd"]();
        _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵelementStart"](14, "div", 11)(15, "textarea", 12);
        _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵlistener"]("ngModelChange", function ImageEditComponent_Template_textarea_ngModelChange_15_listener($event) {
          return ctx.description = $event;
        });
        _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵelementEnd"]()()();
        _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵelementStart"](16, "div", 9)(17, "label", 13);
        _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵtext"](18, "Tags");
        _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵelementEnd"]();
        _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵelementStart"](19, "div", 11)(20, "select", 14);
        _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵtemplate"](21, ImageEditComponent_option_21_Template, 2, 2, "option", 15);
        _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵelementEnd"]()()()();
        _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵelementStart"](22, "div", 16)(23, "button", 17);
        _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵtext"](24, "Close");
        _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵelementEnd"]();
        _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵelementStart"](25, "input", 18);
        _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵlistener"]("click", function ImageEditComponent_Template_input_click_25_listener() {
          return ctx.onSubmit();
        });
        _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵelementEnd"]()()()()()();
      }
      if (rf & 2) {
        _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵadvance"](15);
        _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵproperty"]("ngModel", ctx.description);
        _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵadvance"](6);
        _angular_core__WEBPACK_IMPORTED_MODULE_2__["ɵɵproperty"]("ngForOf", ctx.tagList);
      }
    },
    dependencies: [_angular_common__WEBPACK_IMPORTED_MODULE_4__.NgForOf, _angular_forms__WEBPACK_IMPORTED_MODULE_5__["ɵNgNoValidate"], _angular_forms__WEBPACK_IMPORTED_MODULE_5__.NgSelectOption, _angular_forms__WEBPACK_IMPORTED_MODULE_5__["ɵNgSelectMultipleOption"], _angular_forms__WEBPACK_IMPORTED_MODULE_5__.DefaultValueAccessor, _angular_forms__WEBPACK_IMPORTED_MODULE_5__.NgControlStatus, _angular_forms__WEBPACK_IMPORTED_MODULE_5__.NgControlStatusGroup, _angular_forms__WEBPACK_IMPORTED_MODULE_5__.NgModel, _angular_forms__WEBPACK_IMPORTED_MODULE_5__.NgForm],
    styles: ["\n/*# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbXSwibmFtZXMiOltdLCJtYXBwaW5ncyI6IiIsInNvdXJjZVJvb3QiOiIifQ== */"]
  });
}

/***/ }),

/***/ 386:
/*!**********************************************************!*\
  !*** ./src/app/image/image-info/image-info.component.ts ***!
  \**********************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "ImageInfoComponent": () => (/* binding */ ImageInfoComponent)
/* harmony export */ });
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @angular/core */ 2560);
/* harmony import */ var _services_data_service__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../../services/data.service */ 2468);
/* harmony import */ var _ngbox_ngbox_component__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../../ngbox/ngbox.component */ 3995);
/* harmony import */ var _ngbox_ngbox_directive__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../ngbox/ngbox.directive */ 4126);




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
  static #_ = this.ɵfac = function ImageInfoComponent_Factory(t) {
    return new (t || ImageInfoComponent)(_angular_core__WEBPACK_IMPORTED_MODULE_3__["ɵɵdirectiveInject"](_services_data_service__WEBPACK_IMPORTED_MODULE_0__.DataService));
  };
  static #_2 = this.ɵcmp = /*@__PURE__*/_angular_core__WEBPACK_IMPORTED_MODULE_3__["ɵɵdefineComponent"]({
    type: ImageInfoComponent,
    selectors: [["image-info"]],
    decls: 12,
    vars: 5,
    consts: [[1, "moa-page"], [1, "image-container"], ["ng-box", "", 1, "image-lightbox-link", 3, "href", "title"], [3, "src"], [1, "row"], ["target", "_blank", 1, "btn", "btn-info", "col-md-2", "col-md-offset-5", 3, "href"], [1, "glyphicon", "glyphicon-new-window", "pull-left"]],
    template: function ImageInfoComponent_Template(rf, ctx) {
      if (rf & 1) {
        _angular_core__WEBPACK_IMPORTED_MODULE_3__["ɵɵelementStart"](0, "div", 0)(1, "p");
        _angular_core__WEBPACK_IMPORTED_MODULE_3__["ɵɵtext"](2);
        _angular_core__WEBPACK_IMPORTED_MODULE_3__["ɵɵelementEnd"]();
        _angular_core__WEBPACK_IMPORTED_MODULE_3__["ɵɵelementStart"](3, "div", 1)(4, "a", 2);
        _angular_core__WEBPACK_IMPORTED_MODULE_3__["ɵɵelement"](5, "img", 3);
        _angular_core__WEBPACK_IMPORTED_MODULE_3__["ɵɵelementEnd"]()();
        _angular_core__WEBPACK_IMPORTED_MODULE_3__["ɵɵelement"](6, "br");
        _angular_core__WEBPACK_IMPORTED_MODULE_3__["ɵɵelementStart"](7, "div", 4)(8, "a", 5);
        _angular_core__WEBPACK_IMPORTED_MODULE_3__["ɵɵelement"](9, "span", 6);
        _angular_core__WEBPACK_IMPORTED_MODULE_3__["ɵɵtext"](10, " Open in new tab ");
        _angular_core__WEBPACK_IMPORTED_MODULE_3__["ɵɵelementEnd"]()()();
        _angular_core__WEBPACK_IMPORTED_MODULE_3__["ɵɵelement"](11, "ngbox");
      }
      if (rf & 2) {
        _angular_core__WEBPACK_IMPORTED_MODULE_3__["ɵɵadvance"](2);
        _angular_core__WEBPACK_IMPORTED_MODULE_3__["ɵɵtextInterpolate1"](" ", ctx.image.description, " ");
        _angular_core__WEBPACK_IMPORTED_MODULE_3__["ɵɵadvance"](2);
        _angular_core__WEBPACK_IMPORTED_MODULE_3__["ɵɵproperty"]("href", ctx.getFullImageUrl(), _angular_core__WEBPACK_IMPORTED_MODULE_3__["ɵɵsanitizeUrl"])("title", ctx.image.filename);
        _angular_core__WEBPACK_IMPORTED_MODULE_3__["ɵɵadvance"](1);
        _angular_core__WEBPACK_IMPORTED_MODULE_3__["ɵɵpropertyInterpolate"]("src", ctx.image.image_src, _angular_core__WEBPACK_IMPORTED_MODULE_3__["ɵɵsanitizeUrl"]);
        _angular_core__WEBPACK_IMPORTED_MODULE_3__["ɵɵadvance"](3);
        _angular_core__WEBPACK_IMPORTED_MODULE_3__["ɵɵproperty"]("href", ctx.getFullImageUrl(), _angular_core__WEBPACK_IMPORTED_MODULE_3__["ɵɵsanitizeUrl"]);
      }
    },
    dependencies: [_ngbox_ngbox_component__WEBPACK_IMPORTED_MODULE_1__.NgBoxComponent, _ngbox_ngbox_directive__WEBPACK_IMPORTED_MODULE_2__.NgBoxDirective],
    styles: [".moa-page[_ngcontent-%COMP%] {\n    width: 1140px;\n}\n\n.image-container[_ngcontent-%COMP%] {\n    text-align: center;\n}\n\n.image-lightbox-link[_ngcontent-%COMP%] {\n    text-align: center;\n    cursor: pointer;\n}\n/*# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8uL3NyYy9hcHAvaW1hZ2UvaW1hZ2UtaW5mby9pbWFnZS1pbmZvLmNvbXBvbmVudC5jc3MiXSwibmFtZXMiOltdLCJtYXBwaW5ncyI6IkFBQUE7SUFDSSxhQUFhO0FBQ2pCOztBQUVBO0lBQ0ksa0JBQWtCO0FBQ3RCOztBQUVBO0lBQ0ksa0JBQWtCO0lBQ2xCLGVBQWU7QUFDbkIiLCJzb3VyY2VzQ29udGVudCI6WyIubW9hLXBhZ2Uge1xuICAgIHdpZHRoOiAxMTQwcHg7XG59XG5cbi5pbWFnZS1jb250YWluZXIge1xuICAgIHRleHQtYWxpZ246IGNlbnRlcjtcbn1cblxuLmltYWdlLWxpZ2h0Ym94LWxpbmsge1xuICAgIHRleHQtYWxpZ246IGNlbnRlcjtcbiAgICBjdXJzb3I6IHBvaW50ZXI7XG59Il0sInNvdXJjZVJvb3QiOiIifQ== */"]
  });
}

/***/ }),

/***/ 3128:
/*!**********************************************************!*\
  !*** ./src/app/image/image-list/image-list.component.ts ***!
  \**********************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "ImageListComponent": () => (/* binding */ ImageListComponent)
/* harmony export */ });
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @angular/core */ 2560);
/* harmony import */ var _services_data_service__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../../services/data.service */ 2468);
/* harmony import */ var _services_thumbnail_service__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../../services/thumbnail.service */ 4204);
/* harmony import */ var _angular_common__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! @angular/common */ 4666);
/* harmony import */ var _image_thumb_image_thumb_component__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../image-thumb/image-thumb.component */ 3744);





function ImageListComponent_li_1_Template(rf, ctx) {
  if (rf & 1) {
    _angular_core__WEBPACK_IMPORTED_MODULE_3__["ɵɵelementStart"](0, "li", 2);
    _angular_core__WEBPACK_IMPORTED_MODULE_3__["ɵɵelement"](1, "image-thumb", 3);
    _angular_core__WEBPACK_IMPORTED_MODULE_3__["ɵɵelementEnd"]();
  }
  if (rf & 2) {
    const image_r1 = ctx.$implicit;
    const ctx_r0 = _angular_core__WEBPACK_IMPORTED_MODULE_3__["ɵɵnextContext"]();
    _angular_core__WEBPACK_IMPORTED_MODULE_3__["ɵɵadvance"](1);
    _angular_core__WEBPACK_IMPORTED_MODULE_3__["ɵɵproperty"]("image", image_r1)("gallery_id", ctx_r0.gallery.id);
  }
}
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
  static #_ = this.TARGET_HEIGHT = 300;
  static #_2 = this.GALLERY_WIDTH = 1140;
  ngOnInit() {
    this.checkThumbs();
  }
  checkThumbs() {
    let imageWidths = [];
    let totalWidth = 0;
    if (this.thumbSub !== undefined) this.thumbSub.unsubscribe();
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
      if (toGenerate.length > 0) this.getThumbs(toGenerate);
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
        if (row.width > ImageListComponent.GALLERY_WIDTH && row.images > 1) {
          if (row.width > maxWidth) {
            row.width -= imageWidths[i];
            row.images--;
            rows.push(row);
            row = {
              width: imageWidths[i],
              images: 1
            };
          } else {
            rows.push(row);
            row = {
              width: 0,
              images: 0
            };
          }
        }
        i++;
      }
      if (row.images === 1 && rows.length > 0) {
        rows[rows.length - 1].images++;
        rows[rows.length - 1].width += row.width;
        row = {
          width: 0,
          images: 0
        };
      }
      if (row.images > 1 || rows.length === 0) {
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
          if (image == notDoneYet) found = true;
        }
        if (!found) {
          for (let i of this.images) {
            if (image == i.id) i.isGenerating = false;
          }
        } else {
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
  static #_3 = this.ɵfac = function ImageListComponent_Factory(t) {
    return new (t || ImageListComponent)(_angular_core__WEBPACK_IMPORTED_MODULE_3__["ɵɵdirectiveInject"](_services_data_service__WEBPACK_IMPORTED_MODULE_0__.DataService), _angular_core__WEBPACK_IMPORTED_MODULE_3__["ɵɵdirectiveInject"](_services_thumbnail_service__WEBPACK_IMPORTED_MODULE_1__.ThumbnailService));
  };
  static #_4 = this.ɵcmp = /*@__PURE__*/_angular_core__WEBPACK_IMPORTED_MODULE_3__["ɵɵdefineComponent"]({
    type: ImageListComponent,
    selectors: [["image-list"]],
    decls: 2,
    vars: 1,
    consts: [[1, "list-unstyled"], ["class", "thumbnail", 4, "ngFor", "ngForOf"], [1, "thumbnail"], [3, "image", "gallery_id"]],
    template: function ImageListComponent_Template(rf, ctx) {
      if (rf & 1) {
        _angular_core__WEBPACK_IMPORTED_MODULE_3__["ɵɵelementStart"](0, "ul", 0);
        _angular_core__WEBPACK_IMPORTED_MODULE_3__["ɵɵtemplate"](1, ImageListComponent_li_1_Template, 2, 2, "li", 1);
        _angular_core__WEBPACK_IMPORTED_MODULE_3__["ɵɵelementEnd"]();
      }
      if (rf & 2) {
        _angular_core__WEBPACK_IMPORTED_MODULE_3__["ɵɵadvance"](1);
        _angular_core__WEBPACK_IMPORTED_MODULE_3__["ɵɵproperty"]("ngForOf", ctx.images);
      }
    },
    dependencies: [_angular_common__WEBPACK_IMPORTED_MODULE_4__.NgForOf, _image_thumb_image_thumb_component__WEBPACK_IMPORTED_MODULE_2__.ImageThumbComponent],
    styles: [".thumbnail[_ngcontent-%COMP%] {\n    float: left;\n    margin-bottom: 0;\n}\n/*# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8uL3NyYy9hcHAvaW1hZ2UvaW1hZ2UtbGlzdC9pbWFnZS1saXN0LmNvbXBvbmVudC5jc3MiXSwibmFtZXMiOltdLCJtYXBwaW5ncyI6IkFBQUE7SUFDSSxXQUFXO0lBQ1gsZ0JBQWdCO0FBQ3BCIiwic291cmNlc0NvbnRlbnQiOlsiLnRodW1ibmFpbCB7XG4gICAgZmxvYXQ6IGxlZnQ7XG4gICAgbWFyZ2luLWJvdHRvbTogMDtcbn0iXSwic291cmNlUm9vdCI6IiJ9 */"]
  });
}

/***/ }),

/***/ 3744:
/*!************************************************************!*\
  !*** ./src/app/image/image-thumb/image-thumb.component.ts ***!
  \************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "ImageThumbComponent": () => (/* binding */ ImageThumbComponent)
/* harmony export */ });
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @angular/core */ 2560);
/* harmony import */ var _angular_common__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @angular/common */ 4666);
/* harmony import */ var _angular_router__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @angular/router */ 124);



const _c0 = function (a0, a1) {
  return {
    width: a0,
    height: a1
  };
};
function ImageThumbComponent_img_2_Template(rf, ctx) {
  if (rf & 1) {
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelement"](0, "img", 3);
  }
  if (rf & 2) {
    const ctx_r0 = _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵnextContext"]();
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵpropertyInterpolate1"]("src", "/image/thumb/", ctx_r0.image.id, ".jpg", _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵsanitizeUrl"]);
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵproperty"]("ngStyle", _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵpureFunction2"](2, _c0, ctx_r0.image.displayWidth - 10 + "px", ctx_r0.image.displayHeight + "px"));
  }
}
function ImageThumbComponent_img_3_Template(rf, ctx) {
  if (rf & 1) {
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelement"](0, "img", 3);
  }
  if (rf & 2) {
    const ctx_r1 = _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵnextContext"]();
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵpropertyInterpolate1"]("src", "/image/thumb/", ctx_r1.image.id, "-w.jpg", _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵsanitizeUrl"]);
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵproperty"]("ngStyle", _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵpureFunction2"](2, _c0, ctx_r1.image.displayWidth - 10 + "px", ctx_r1.image.displayHeight + "px"));
  }
}
function ImageThumbComponent_img_4_Template(rf, ctx) {
  if (rf & 1) {
    _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelement"](0, "img", 4);
  }
}
const _c1 = function (a0) {
  return [a0];
};
class ImageThumbComponent {
  constructor() {}
  getLink() {
    return '/image/' + this.gallery_id + '/' + this.image.id;
  }
  static #_ = this.ɵfac = function ImageThumbComponent_Factory(t) {
    return new (t || ImageThumbComponent)();
  };
  static #_2 = this.ɵcmp = /*@__PURE__*/_angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵdefineComponent"]({
    type: ImageThumbComponent,
    selectors: [["image-thumb"]],
    inputs: {
      image: "image",
      gallery_id: "gallery_id"
    },
    decls: 7,
    vars: 7,
    consts: [[3, "routerLink"], [3, "src", "ngStyle", 4, "ngIf"], ["src", "/media/spinner.svg", "class", "thumbnail-generating", 4, "ngIf"], [3, "src", "ngStyle"], ["src", "/media/spinner.svg", 1, "thumbnail-generating"]],
    template: function ImageThumbComponent_Template(rf, ctx) {
      if (rf & 1) {
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementStart"](0, "div")(1, "a", 0);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵtemplate"](2, ImageThumbComponent_img_2_Template, 1, 5, "img", 1);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵtemplate"](3, ImageThumbComponent_img_3_Template, 1, 5, "img", 1);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵtemplate"](4, ImageThumbComponent_img_4_Template, 1, 0, "img", 2);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementStart"](5, "span");
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵtext"](6);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵelementEnd"]()()();
      }
      if (rf & 2) {
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵadvance"](1);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵproperty"]("routerLink", _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵpureFunction1"](5, _c1, ctx.getLink()));
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵadvance"](1);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵproperty"]("ngIf", !ctx.image.isGenerating && ctx.image.displayWidth <= 450 && ctx.image.displayHeight <= 300);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵadvance"](1);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵproperty"]("ngIf", !ctx.image.isGenerating && (ctx.image.displayWidth > 450 || ctx.image.displayHeight > 300));
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵadvance"](1);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵproperty"]("ngIf", ctx.image.isGenerating);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵadvance"](2);
        _angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵtextInterpolate"](ctx.image.filename);
      }
    },
    dependencies: [_angular_common__WEBPACK_IMPORTED_MODULE_1__.NgIf, _angular_common__WEBPACK_IMPORTED_MODULE_1__.NgStyle, _angular_router__WEBPACK_IMPORTED_MODULE_2__.RouterLink],
    styles: [".thumbnail-generating[_ngcontent-%COMP%] {\n    width: 64px;\n    height: 64px;\n    margin: 62px 109px;\n}\n\n.thumbnail-image-container[_ngcontent-%COMP%] {\n    overflow: hidden;\n    text-align: center;\n    background-color: rgba(0, 0, 0, 0.05);\n}\n/*# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8uL3NyYy9hcHAvaW1hZ2UvaW1hZ2UtdGh1bWIvaW1hZ2UtdGh1bWIuY29tcG9uZW50LmNzcyJdLCJuYW1lcyI6W10sIm1hcHBpbmdzIjoiQUFBQTtJQUNJLFdBQVc7SUFDWCxZQUFZO0lBQ1osa0JBQWtCO0FBQ3RCOztBQUVBO0lBQ0ksZ0JBQWdCO0lBQ2hCLGtCQUFrQjtJQUNsQixxQ0FBcUM7QUFDekMiLCJzb3VyY2VzQ29udGVudCI6WyIudGh1bWJuYWlsLWdlbmVyYXRpbmcge1xuICAgIHdpZHRoOiA2NHB4O1xuICAgIGhlaWdodDogNjRweDtcbiAgICBtYXJnaW46IDYycHggMTA5cHg7XG59XG5cbi50aHVtYm5haWwtaW1hZ2UtY29udGFpbmVyIHtcbiAgICBvdmVyZmxvdzogaGlkZGVuO1xuICAgIHRleHQtYWxpZ246IGNlbnRlcjtcbiAgICBiYWNrZ3JvdW5kLWNvbG9yOiByZ2JhKDAsIDAsIDAsIDAuMDUpO1xufSJdLCJzb3VyY2VSb290IjoiIn0= */"]
  });
}

/***/ }),

/***/ 9458:
/*!****************************************************************!*\
  !*** ./src/app/image/image-toolbar/image-toolbar.component.ts ***!
  \****************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "ImageToolbarComponent": () => (/* binding */ ImageToolbarComponent)
/* harmony export */ });
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! @angular/core */ 2560);
/* harmony import */ var _services_data_service__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../../services/data.service */ 2468);
/* harmony import */ var _services_button_click_service__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../../services/button-click.service */ 4872);
/* harmony import */ var _image_service__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../image.service */ 964);
/* harmony import */ var _angular_router__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! @angular/router */ 124);
/* harmony import */ var _image_edit_image_edit_component__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../image-edit/image-edit.component */ 6424);






class ImageToolbarComponent {
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
      /*this.imageService.DeleteImage(this.image.id).subscribe(next => {
          let options =
              {
                  message: 'Image deleted',
                  container: '#editSuccessContainer',
                  duration: 5000
              };
          $.meow(options);
           this.router.navigate(['/gallery/' + this.image.gallery_id]);
      });*/
    }
  }
  ngOnDestroy() {
    this.observer.unsubscribe();
  }
  static #_ = this.ɵfac = function ImageToolbarComponent_Factory(t) {
    return new (t || ImageToolbarComponent)(_angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵdirectiveInject"](_services_data_service__WEBPACK_IMPORTED_MODULE_0__.DataService), _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵdirectiveInject"](_services_button_click_service__WEBPACK_IMPORTED_MODULE_1__.ButtonClickService), _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵdirectiveInject"](_image_service__WEBPACK_IMPORTED_MODULE_2__.ImageService), _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵdirectiveInject"](_angular_router__WEBPACK_IMPORTED_MODULE_5__.Router));
  };
  static #_2 = this.ɵcmp = /*@__PURE__*/_angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵdefineComponent"]({
    type: ImageToolbarComponent,
    selectors: [["image-toolbar"]],
    decls: 8,
    vars: 1,
    consts: [[3, "image"], [1, "row"], [1, "pull-right"], ["role", "group", "aria-label", "...", 1, "btn-group"], ["type", "button", "id", "imageEdit", "title", "Edit image", "data-toggle", "tooltip", 1, "btn", "btn-default", 3, "click"], [1, "glyphicon", "glyphicon-pencil"], ["type", "button", "id", "imageDelete", "title", "Delete image", "data-toggle", "tooltip", 1, "btn", "btn-default", 3, "click"], [1, "glyphicon", "glyphicon-trash"]],
    template: function ImageToolbarComponent_Template(rf, ctx) {
      if (rf & 1) {
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelement"](0, "image-edit", 0);
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementStart"](1, "div", 1)(2, "div", 2)(3, "div", 3)(4, "button", 4);
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵlistener"]("click", function ImageToolbarComponent_Template_button_click_4_listener() {
          return ctx.onEditClick();
        });
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelement"](5, "span", 5);
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementEnd"]();
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementStart"](6, "button", 6);
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵlistener"]("click", function ImageToolbarComponent_Template_button_click_6_listener() {
          return ctx.onDeleteClick();
        });
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelement"](7, "span", 7);
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵelementEnd"]()()()();
      }
      if (rf & 2) {
        _angular_core__WEBPACK_IMPORTED_MODULE_4__["ɵɵproperty"]("image", ctx.image);
      }
    },
    dependencies: [_image_edit_image_edit_component__WEBPACK_IMPORTED_MODULE_3__.ImageEditComponent],
    styles: ["\n/*# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbXSwibmFtZXMiOltdLCJtYXBwaW5ncyI6IiIsInNvdXJjZVJvb3QiOiIifQ== */"]
  });
}

/***/ }),

/***/ 964:
/*!****************************************!*\
  !*** ./src/app/image/image.service.ts ***!
  \****************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "ImageService": () => (/* binding */ ImageService)
/* harmony export */ });
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @angular/core */ 2560);
/* harmony import */ var _angular_common_http__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @angular/common/http */ 8987);


class ImageService {
  constructor(http) {
    this.http = http;
    this.api_url = '/api/image/';
  }
  static #_ = this.ɵfac = function ImageService_Factory(t) {
    return new (t || ImageService)(_angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵinject"](_angular_common_http__WEBPACK_IMPORTED_MODULE_1__.HttpClient));
  };
  static #_2 = this.ɵprov = /*@__PURE__*/_angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵdefineInjectable"]({
    token: ImageService,
    factory: ImageService.ɵfac
  });
}

/***/ }),

/***/ 3995:
/*!******************************************!*\
  !*** ./src/app/ngbox/ngbox.component.ts ***!
  \******************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "NgBoxComponent": () => (/* binding */ NgBoxComponent)
/* harmony export */ });
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @angular/core */ 2560);
/* harmony import */ var _ngbox_service__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./ngbox.service */ 1571);
/* harmony import */ var _angular_common__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @angular/common */ 4666);




const _c0 = ["ngBoxContent"];
const _c1 = ["ngBoxButtons"];
function NgBoxComponent_div_0_Template(rf, ctx) {
  if (rf & 1) {
    _angular_core__WEBPACK_IMPORTED_MODULE_1__["ɵɵelementStart"](0, "div", 2);
    _angular_core__WEBPACK_IMPORTED_MODULE_1__["ɵɵelement"](1, "img", 3);
    _angular_core__WEBPACK_IMPORTED_MODULE_1__["ɵɵelementEnd"]();
  }
}
function NgBoxComponent_div_1_img_2_Template(rf, ctx) {
  if (rf & 1) {
    const _r12 = _angular_core__WEBPACK_IMPORTED_MODULE_1__["ɵɵgetCurrentView"]();
    _angular_core__WEBPACK_IMPORTED_MODULE_1__["ɵɵelementStart"](0, "img", 16);
    _angular_core__WEBPACK_IMPORTED_MODULE_1__["ɵɵlistener"]("click", function NgBoxComponent_div_1_img_2_Template_img_click_0_listener() {
      _angular_core__WEBPACK_IMPORTED_MODULE_1__["ɵɵrestoreView"](_r12);
      const ctx_r11 = _angular_core__WEBPACK_IMPORTED_MODULE_1__["ɵɵnextContext"](2);
      return _angular_core__WEBPACK_IMPORTED_MODULE_1__["ɵɵresetView"](ctx_r11.previousNgBox());
    });
    _angular_core__WEBPACK_IMPORTED_MODULE_1__["ɵɵelementEnd"]();
  }
}
function NgBoxComponent_div_1_img_3_Template(rf, ctx) {
  if (rf & 1) {
    const _r14 = _angular_core__WEBPACK_IMPORTED_MODULE_1__["ɵɵgetCurrentView"]();
    _angular_core__WEBPACK_IMPORTED_MODULE_1__["ɵɵelementStart"](0, "img", 17);
    _angular_core__WEBPACK_IMPORTED_MODULE_1__["ɵɵlistener"]("click", function NgBoxComponent_div_1_img_3_Template_img_click_0_listener() {
      _angular_core__WEBPACK_IMPORTED_MODULE_1__["ɵɵrestoreView"](_r14);
      const ctx_r13 = _angular_core__WEBPACK_IMPORTED_MODULE_1__["ɵɵnextContext"](2);
      return _angular_core__WEBPACK_IMPORTED_MODULE_1__["ɵɵresetView"](ctx_r13.nextNgBox());
    });
    _angular_core__WEBPACK_IMPORTED_MODULE_1__["ɵɵelementEnd"]();
  }
}
function NgBoxComponent_div_1_img_4_Template(rf, ctx) {
  if (rf & 1) {
    const _r17 = _angular_core__WEBPACK_IMPORTED_MODULE_1__["ɵɵgetCurrentView"]();
    _angular_core__WEBPACK_IMPORTED_MODULE_1__["ɵɵelementStart"](0, "img", 18, 19);
    _angular_core__WEBPACK_IMPORTED_MODULE_1__["ɵɵlistener"]("load", function NgBoxComponent_div_1_img_4_Template_img_load_0_listener() {
      _angular_core__WEBPACK_IMPORTED_MODULE_1__["ɵɵrestoreView"](_r17);
      const ctx_r16 = _angular_core__WEBPACK_IMPORTED_MODULE_1__["ɵɵnextContext"](2);
      return _angular_core__WEBPACK_IMPORTED_MODULE_1__["ɵɵresetView"](ctx_r16.isLoaded());
    })("click", function NgBoxComponent_div_1_img_4_Template_img_click_0_listener() {
      _angular_core__WEBPACK_IMPORTED_MODULE_1__["ɵɵrestoreView"](_r17);
      const ctx_r18 = _angular_core__WEBPACK_IMPORTED_MODULE_1__["ɵɵnextContext"](2);
      return _angular_core__WEBPACK_IMPORTED_MODULE_1__["ɵɵresetView"](ctx_r18.nextNgBox());
    });
    _angular_core__WEBPACK_IMPORTED_MODULE_1__["ɵɵelementEnd"]();
  }
  if (rf & 2) {
    const ctx_r4 = _angular_core__WEBPACK_IMPORTED_MODULE_1__["ɵɵnextContext"](2);
    _angular_core__WEBPACK_IMPORTED_MODULE_1__["ɵɵproperty"]("src", ctx_r4.ngBox.current.url, _angular_core__WEBPACK_IMPORTED_MODULE_1__["ɵɵsanitizeUrl"])("hidden", ctx_r4.ngBox.loading);
  }
}
function NgBoxComponent_div_1_iframe_5_Template(rf, ctx) {
  if (rf & 1) {
    _angular_core__WEBPACK_IMPORTED_MODULE_1__["ɵɵelement"](0, "iframe", 20, 19);
  }
  if (rf & 2) {
    const ctx_r5 = _angular_core__WEBPACK_IMPORTED_MODULE_1__["ɵɵnextContext"](2);
    _angular_core__WEBPACK_IMPORTED_MODULE_1__["ɵɵpropertyInterpolate"]("width", ctx_r5.ngBox.current.width);
    _angular_core__WEBPACK_IMPORTED_MODULE_1__["ɵɵpropertyInterpolate"]("height", ctx_r5.ngBox.current.height);
    _angular_core__WEBPACK_IMPORTED_MODULE_1__["ɵɵproperty"]("src", ctx_r5.ngBox.current.url, _angular_core__WEBPACK_IMPORTED_MODULE_1__["ɵɵsanitizeResourceUrl"]);
  }
}
function NgBoxComponent_div_1_iframe_6_Template(rf, ctx) {
  if (rf & 1) {
    _angular_core__WEBPACK_IMPORTED_MODULE_1__["ɵɵelement"](0, "iframe", 21, 19);
  }
  if (rf & 2) {
    const ctx_r6 = _angular_core__WEBPACK_IMPORTED_MODULE_1__["ɵɵnextContext"](2);
    _angular_core__WEBPACK_IMPORTED_MODULE_1__["ɵɵpropertyInterpolate"]("width", ctx_r6.ngBox.current.width);
    _angular_core__WEBPACK_IMPORTED_MODULE_1__["ɵɵpropertyInterpolate"]("height", ctx_r6.ngBox.current.height);
    _angular_core__WEBPACK_IMPORTED_MODULE_1__["ɵɵproperty"]("src", ctx_r6.ngBox.current.url, _angular_core__WEBPACK_IMPORTED_MODULE_1__["ɵɵsanitizeResourceUrl"]);
  }
}
function NgBoxComponent_div_1_iframe_7_Template(rf, ctx) {
  if (rf & 1) {
    _angular_core__WEBPACK_IMPORTED_MODULE_1__["ɵɵelement"](0, "iframe", 20, 19);
  }
  if (rf & 2) {
    const ctx_r7 = _angular_core__WEBPACK_IMPORTED_MODULE_1__["ɵɵnextContext"](2);
    _angular_core__WEBPACK_IMPORTED_MODULE_1__["ɵɵpropertyInterpolate"]("width", ctx_r7.ngBox.current.width);
    _angular_core__WEBPACK_IMPORTED_MODULE_1__["ɵɵpropertyInterpolate"]("height", ctx_r7.ngBox.current.height);
    _angular_core__WEBPACK_IMPORTED_MODULE_1__["ɵɵproperty"]("src", ctx_r7.ngBox.current.url, _angular_core__WEBPACK_IMPORTED_MODULE_1__["ɵɵsanitizeResourceUrl"]);
  }
}
function NgBoxComponent_div_1_span_11_Template(rf, ctx) {
  if (rf & 1) {
    _angular_core__WEBPACK_IMPORTED_MODULE_1__["ɵɵelementStart"](0, "span", 22);
    _angular_core__WEBPACK_IMPORTED_MODULE_1__["ɵɵtext"](1);
    _angular_core__WEBPACK_IMPORTED_MODULE_1__["ɵɵelement"](2, "br");
    _angular_core__WEBPACK_IMPORTED_MODULE_1__["ɵɵelementEnd"]();
  }
  if (rf & 2) {
    const ctx_r9 = _angular_core__WEBPACK_IMPORTED_MODULE_1__["ɵɵnextContext"](2);
    _angular_core__WEBPACK_IMPORTED_MODULE_1__["ɵɵadvance"](1);
    _angular_core__WEBPACK_IMPORTED_MODULE_1__["ɵɵtextInterpolate"](ctx_r9.ngBox.current.title);
  }
}
function NgBoxComponent_div_1_span_12_Template(rf, ctx) {
  if (rf & 1) {
    _angular_core__WEBPACK_IMPORTED_MODULE_1__["ɵɵelementStart"](0, "span", 23);
    _angular_core__WEBPACK_IMPORTED_MODULE_1__["ɵɵtext"](1);
    _angular_core__WEBPACK_IMPORTED_MODULE_1__["ɵɵelementEnd"]();
  }
  if (rf & 2) {
    const ctx_r10 = _angular_core__WEBPACK_IMPORTED_MODULE_1__["ɵɵnextContext"](2);
    _angular_core__WEBPACK_IMPORTED_MODULE_1__["ɵɵadvance"](1);
    _angular_core__WEBPACK_IMPORTED_MODULE_1__["ɵɵtextInterpolate2"]("", ctx_r10.getCurrentIndex(), " of ", ctx_r10.getCount(), "");
  }
}
const _c2 = function (a0) {
  return {
    "padding-top": a0
  };
};
function NgBoxComponent_div_1_Template(rf, ctx) {
  if (rf & 1) {
    const _r23 = _angular_core__WEBPACK_IMPORTED_MODULE_1__["ɵɵgetCurrentView"]();
    _angular_core__WEBPACK_IMPORTED_MODULE_1__["ɵɵelementStart"](0, "div", 4);
    _angular_core__WEBPACK_IMPORTED_MODULE_1__["ɵɵlistener"]("click", function NgBoxComponent_div_1_Template_div_click_0_listener($event) {
      _angular_core__WEBPACK_IMPORTED_MODULE_1__["ɵɵrestoreView"](_r23);
      const ctx_r22 = _angular_core__WEBPACK_IMPORTED_MODULE_1__["ɵɵnextContext"]();
      return _angular_core__WEBPACK_IMPORTED_MODULE_1__["ɵɵresetView"](ctx_r22.closeOutside($event));
    });
    _angular_core__WEBPACK_IMPORTED_MODULE_1__["ɵɵelementStart"](1, "div", 5);
    _angular_core__WEBPACK_IMPORTED_MODULE_1__["ɵɵtemplate"](2, NgBoxComponent_div_1_img_2_Template, 1, 0, "img", 6);
    _angular_core__WEBPACK_IMPORTED_MODULE_1__["ɵɵtemplate"](3, NgBoxComponent_div_1_img_3_Template, 1, 0, "img", 7);
    _angular_core__WEBPACK_IMPORTED_MODULE_1__["ɵɵtemplate"](4, NgBoxComponent_div_1_img_4_Template, 2, 2, "img", 8);
    _angular_core__WEBPACK_IMPORTED_MODULE_1__["ɵɵtemplate"](5, NgBoxComponent_div_1_iframe_5_Template, 2, 3, "iframe", 9);
    _angular_core__WEBPACK_IMPORTED_MODULE_1__["ɵɵtemplate"](6, NgBoxComponent_div_1_iframe_6_Template, 2, 3, "iframe", 10);
    _angular_core__WEBPACK_IMPORTED_MODULE_1__["ɵɵtemplate"](7, NgBoxComponent_div_1_iframe_7_Template, 2, 3, "iframe", 9);
    _angular_core__WEBPACK_IMPORTED_MODULE_1__["ɵɵelementEnd"]();
    _angular_core__WEBPACK_IMPORTED_MODULE_1__["ɵɵelementStart"](8, "div", 11, 12)(10, "p");
    _angular_core__WEBPACK_IMPORTED_MODULE_1__["ɵɵtemplate"](11, NgBoxComponent_div_1_span_11_Template, 3, 1, "span", 13);
    _angular_core__WEBPACK_IMPORTED_MODULE_1__["ɵɵtemplate"](12, NgBoxComponent_div_1_span_12_Template, 2, 2, "span", 14);
    _angular_core__WEBPACK_IMPORTED_MODULE_1__["ɵɵelementEnd"]();
    _angular_core__WEBPACK_IMPORTED_MODULE_1__["ɵɵelementStart"](13, "img", 15);
    _angular_core__WEBPACK_IMPORTED_MODULE_1__["ɵɵlistener"]("click", function NgBoxComponent_div_1_Template_img_click_13_listener() {
      _angular_core__WEBPACK_IMPORTED_MODULE_1__["ɵɵrestoreView"](_r23);
      const ctx_r24 = _angular_core__WEBPACK_IMPORTED_MODULE_1__["ɵɵnextContext"]();
      return _angular_core__WEBPACK_IMPORTED_MODULE_1__["ɵɵresetView"](ctx_r24.closeNgBox());
    });
    _angular_core__WEBPACK_IMPORTED_MODULE_1__["ɵɵelementEnd"]()()();
  }
  if (rf & 2) {
    const ctx_r1 = _angular_core__WEBPACK_IMPORTED_MODULE_1__["ɵɵnextContext"]();
    _angular_core__WEBPACK_IMPORTED_MODULE_1__["ɵɵproperty"]("ngStyle", _angular_core__WEBPACK_IMPORTED_MODULE_1__["ɵɵpureFunction1"](10, _c2, ctx_r1.offsetHeight + "px"));
    _angular_core__WEBPACK_IMPORTED_MODULE_1__["ɵɵadvance"](2);
    _angular_core__WEBPACK_IMPORTED_MODULE_1__["ɵɵproperty"]("ngIf", ctx_r1.getHasGroup());
    _angular_core__WEBPACK_IMPORTED_MODULE_1__["ɵɵadvance"](1);
    _angular_core__WEBPACK_IMPORTED_MODULE_1__["ɵɵproperty"]("ngIf", ctx_r1.getHasGroup());
    _angular_core__WEBPACK_IMPORTED_MODULE_1__["ɵɵadvance"](1);
    _angular_core__WEBPACK_IMPORTED_MODULE_1__["ɵɵproperty"]("ngIf", ctx_r1.ngBox.current.type == 1);
    _angular_core__WEBPACK_IMPORTED_MODULE_1__["ɵɵadvance"](1);
    _angular_core__WEBPACK_IMPORTED_MODULE_1__["ɵɵproperty"]("ngIf", ctx_r1.ngBox.current.type == 2);
    _angular_core__WEBPACK_IMPORTED_MODULE_1__["ɵɵadvance"](1);
    _angular_core__WEBPACK_IMPORTED_MODULE_1__["ɵɵproperty"]("ngIf", ctx_r1.ngBox.current.type == 3);
    _angular_core__WEBPACK_IMPORTED_MODULE_1__["ɵɵadvance"](1);
    _angular_core__WEBPACK_IMPORTED_MODULE_1__["ɵɵproperty"]("ngIf", ctx_r1.ngBox.current.type == 4);
    _angular_core__WEBPACK_IMPORTED_MODULE_1__["ɵɵadvance"](1);
    _angular_core__WEBPACK_IMPORTED_MODULE_1__["ɵɵproperty"]("hidden", ctx_r1.ngBox.loading);
    _angular_core__WEBPACK_IMPORTED_MODULE_1__["ɵɵadvance"](3);
    _angular_core__WEBPACK_IMPORTED_MODULE_1__["ɵɵproperty"]("ngIf", ctx_r1.ngBox.current.title);
    _angular_core__WEBPACK_IMPORTED_MODULE_1__["ɵɵadvance"](1);
    _angular_core__WEBPACK_IMPORTED_MODULE_1__["ɵɵproperty"]("ngIf", ctx_r1.getHasGroup());
  }
}
class NgBoxComponent {
  constructor(ngBox) {
    this.ngBox = ngBox;
    this.showMore = new _angular_core__WEBPACK_IMPORTED_MODULE_1__.EventEmitter();
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
      let realWidth = this.elementView.nativeElement.naturalWidth ? this.elementView.nativeElement.naturalWidth : currentWidth;
      let realHeight = this.elementView.nativeElement.naturalHeight ? this.elementView.nativeElement.naturalHeight : currentHeight;
      let maxWidth = Math.min(window.innerWidth - 70, currentWidth ? currentWidth : realWidth);
      let maxHeight = Math.min(window.innerHeight - 60, currentHeight ? currentHeight : realHeight);
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
    } else if (event.keyCode === 37) {
      this.previousNgBox();
    } else if (event.keyCode === 27) {
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
    } else {
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
  static #_ = this.ɵfac = function NgBoxComponent_Factory(t) {
    return new (t || NgBoxComponent)(_angular_core__WEBPACK_IMPORTED_MODULE_1__["ɵɵdirectiveInject"](_ngbox_service__WEBPACK_IMPORTED_MODULE_0__.NgBoxService));
  };
  static #_2 = this.ɵcmp = /*@__PURE__*/_angular_core__WEBPACK_IMPORTED_MODULE_1__["ɵɵdefineComponent"]({
    type: NgBoxComponent,
    selectors: [["my-ngbox"], ["ngbox"]],
    viewQuery: function NgBoxComponent_Query(rf, ctx) {
      if (rf & 1) {
        _angular_core__WEBPACK_IMPORTED_MODULE_1__["ɵɵviewQuery"](_c0, 5);
        _angular_core__WEBPACK_IMPORTED_MODULE_1__["ɵɵviewQuery"](_c1, 5);
      }
      if (rf & 2) {
        let _t;
        _angular_core__WEBPACK_IMPORTED_MODULE_1__["ɵɵqueryRefresh"](_t = _angular_core__WEBPACK_IMPORTED_MODULE_1__["ɵɵloadQuery"]()) && (ctx.elementView = _t.first);
        _angular_core__WEBPACK_IMPORTED_MODULE_1__["ɵɵqueryRefresh"](_t = _angular_core__WEBPACK_IMPORTED_MODULE_1__["ɵɵloadQuery"]()) && (ctx.elementButtons = _t.first);
      }
    },
    hostBindings: function NgBoxComponent_HostBindings(rf, ctx) {
      if (rf & 1) {
        _angular_core__WEBPACK_IMPORTED_MODULE_1__["ɵɵlistener"]("resize", function NgBoxComponent_resize_HostBindingHandler($event) {
          return ctx.resize($event);
        }, false, _angular_core__WEBPACK_IMPORTED_MODULE_1__["ɵɵresolveWindow"])("keydown", function NgBoxComponent_keydown_HostBindingHandler($event) {
          return ctx.checkKeyPress($event);
        }, false, _angular_core__WEBPACK_IMPORTED_MODULE_1__["ɵɵresolveWindow"]);
      }
    },
    inputs: {
      data: "data"
    },
    outputs: {
      showMore: "showMore"
    },
    decls: 2,
    vars: 2,
    consts: [["id", "ngBoxLoading", 4, "ngIf"], ["id", "ngBoxWrapper", 3, "ngStyle", "click", 4, "ngIf"], ["id", "ngBoxLoading"], ["src", "data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNv\nZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9Im5vIj8+PHN2ZyB4bWxuczpzdmc9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxucz0iaHR0cD\novL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB2ZXJzaW9uPSIxLjAiIHdpZHRo\nPSIxNjBweCIgaGVpZ2h0PSIyMHB4IiB2aWV3Qm94PSIwIDAgMTI4IDE2IiB4bWw6c3BhY2U9InByZXNlcnZlIj48c2NyaXB0IHR5cGU9InRleHQvZW\nNtYXNjcmlwdCIgeGxpbms6aHJlZj0iLy9wcmVsb2FkZXJzLm5ldC9qc2NyaXB0cy9zbWlsLnVzZXIuanMiLz48cGF0aCBmaWxsPSIjZmZmZmZmIiBm\naWxsLW9wYWNpdHk9IjAuNDE5NjA3ODQzMTM3MjUiIGQ9Ik02LjQsNC44QTMuMiwzLjIsMCwxLDEsMy4yLDgsMy4yLDMuMiwwLDAsMSw2LjQsNC44Wm\n0xMi44LDBBMy4yLDMuMiwwLDEsMSwxNiw4LDMuMiwzLjIsMCwwLDEsMTkuMiw0LjhaTTMyLDQuOEEzLjIsMy4yLDAsMSwxLDI4LjgsOCwzLjIsMy4y\nLDAsMCwxLDMyLDQuOFptMTIuOCwwQTMuMiwzLjIsMCwxLDEsNDEuNiw4LDMuMiwzLjIsMCwwLDEsNDQuOCw0LjhabTEyLjgsMEEzLjIsMy4yLDAsMS\nwxLDU0LjQsOCwzLjIsMy4yLDAsMCwxLDU3LjYsNC44Wm0xMi44LDBBMy4yLDMuMiwwLDEsMSw2Ny4yLDgsMy4yLDMuMiwwLDAsMSw3MC40LDQuOFpt\nMTIuOCwwQTMuMiwzLjIsMCwxLDEsODAsOCwzLjIsMy4yLDAsMCwxLDgzLjIsNC44Wk05Niw0LjhBMy4yLDMuMiwwLDEsMSw5Mi44LDgsMy4yLDMuMi\nwwLDAsMSw5Niw0LjhabTEyLjgsMEEzLjIsMy4yLDAsMSwxLDEwNS42LDgsMy4yLDMuMiwwLDAsMSwxMDguOCw0LjhabTEyLjgsMEEzLjIsMy4yLDAs\nMSwxLDExOC40LDgsMy4yLDMuMiwwLDAsMSwxMjEuNiw0LjhaIi8+PGc+PHBhdGggZmlsbD0iI2ZmZmZmZiIgZmlsbC1vcGFjaXR5PSIxIiBkPSJNLT\nQyLjcsMy44NEE0LjE2LDQuMTYsMCwwLDEtMzguNTQsOGE0LjE2LDQuMTYsMCwwLDEtNC4xNiw0LjE2QTQuMTYsNC4xNiwwLDAsMS00Ni44Niw4LDQu\nMTYsNC4xNiwwLDAsMS00Mi43LDMuODRabTEyLjgtLjY0QTQuOCw0LjgsMCwwLDEtMjUuMSw4YTQuOCw0LjgsMCwwLDEtNC44LDQuOEE0LjgsNC44LD\nAsMCwxLTM0LjcsOCw0LjgsNC44LDAsMCwxLTI5LjksMy4yWm0xMi44LS42NEE1LjQ0LDUuNDQsMCwwLDEtMTEuNjYsOGE1LjQ0LDUuNDQsMCwwLDEt\nNS40NCw1LjQ0QTUuNDQsNS40NCwwLDAsMS0yMi41NCw4LDUuNDQsNS40NCwwLDAsMS0xNy4xLDIuNTZaIi8+PGFuaW1hdGVUcmFuc2Zvcm0gYXR0cm\nlidXRlTmFtZT0idHJhbnNmb3JtIiB0eXBlPSJ0cmFuc2xhdGUiIHZhbHVlcz0iMjMgMDszNiAwOzQ5IDA7NjIgMDs3NC41IDA7ODcuNSAwOzEwMCAw\nOzExMyAwOzEyNS41IDA7MTM4LjUgMDsxNTEuNSAwOzE2NC41IDA7MTc4IDAiIGNhbGNNb2RlPSJkaXNjcmV0ZSIgZHVyPSI3ODBtcyIgcmVwZWF0Q2\n91bnQ9ImluZGVmaW5pdGUiLz48L2c+PC9zdmc+Cg=="], ["id", "ngBoxWrapper", 3, "ngStyle", "click"], ["id", "ngBoxContent"], ["class", "left", "src", "data:image/svg+xml;base64,PD94bWwgdmVyc2lvb\nj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz4NCjwhLS0gR2VuZXJhdG9yOiBBZG9iZSBJbGx1c3RyYXRvciAxNS4xLjAsIFNWRyBFeHBvcnQgUGx1Zy1JbiAuIFNWRyB\nWZXJzaW9uOiA2LjAwIEJ1aWxkIDApICAtLT4NCjwhRE9DVFlQRSBzdmcgUFVCTElDICItLy9XM0MvL0RURCBTVkcgMS4xLy9FTiIgImh0dHA6Ly93d3cudzMub3JnL\n0dyYXBoaWNzL1NWRy8xLjEvRFREL3N2ZzExLmR0ZCI+DQo8c3ZnIHZlcnNpb249IjEuMSIgaWQ9IkxheWVyXzEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDA\nwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHg9IjBweCIgeT0iMHB4Ig0KCSB3aWR0aD0iNzBweCIgaGVpZ2h0PSIxMDBwe\nCIgdmlld0JveD0iMCAwIDcwIDEwMCIgZW5hYmxlLWJhY2tncm91bmQ9Im5ldyAwIDAgNzAgMTAwIiB4bWw6c3BhY2U9InByZXNlcnZlIj4NCjxwb2x5Z29uIGZpbGw\n9IiNGRkZGRkYiIHN0cm9rZT0iIzZCNkI2QiIgc3Ryb2tlLW1pdGVybGltaXQ9IjEwIiBwb2ludHM9IjQ1LjYsOTguNTI0IDE0LjU0NCw1MCA0NS42LDEuNDc2IDQ4L\njgwMSwzLjUyNCAxOS4wNTYsNTAgDQoJNDguODAxLDk2LjQ3NiAiLz4NCjwvc3ZnPg0K", 3, "click", 4, "ngIf"], ["class", "right", "src", "data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0i\nMS4wIiBlbmNvZGluZz0idXRmLTgiPz4NCjwhLS0gR2VuZXJhdG9yOiBBZG9iZSBJbGx1c3RyYXRvciAxNS4xLjAsIFNWRyBFeHBvcnQgUGx1Zy1JbiAuIFNWRyBWZX\nJzaW9uOiA2LjAwIEJ1aWxkIDApICAtLT4NCjwhRE9DVFlQRSBzdmcgUFVCTElDICItLy9XM0MvL0RURCBTVkcgMS4xLy9FTiIgImh0dHA6Ly93d3cudzMub3JnL0dy\nYXBoaWNzL1NWRy8xLjEvRFREL3N2ZzExLmR0ZCI+DQo8c3ZnIHZlcnNpb249IjEuMSIgaWQ9IkxheWVyXzEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3\nN2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHg9IjBweCIgeT0iMHB4Ig0KCSB3aWR0aD0iNzBweCIgaGVpZ2h0PSIxMDBweCIg\ndmlld0JveD0iMCAwIDcwIDEwMCIgZW5hYmxlLWJhY2tncm91bmQ9Im5ldyAwIDAgNzAgMTAwIiB4bWw6c3BhY2U9InByZXNlcnZlIj4NCjxwb2x5Z29uIGZpbGw9Ii\nNGRkZGRkYiIHN0cm9rZT0iIzZCNkI2QiIgc3Ryb2tlLW1pdGVybGltaXQ9IjEwIiBwb2ludHM9IjE3Ljc0Niw5OC41MjQgNDguODAxLDUwIDE3Ljc0NiwxLjQ3NiAx\nNC41NDUsMy41MjQgDQoJNDQuMjg5LDUwIDE0LjU0NSw5Ni40NzYgIi8+DQo8L3N2Zz4NCg==", 3, "click", 4, "ngIf"], ["alt", "", 3, "src", "hidden", "load", "click", 4, "ngIf"], ["frameborder", "0", "allowfullscreen", "", 3, "src", "width", "height", 4, "ngIf"], ["frameborder", "0", "webkitallowfullscreen", "", "mozallowfullscreen", "", "allowfullscreen", "", 3, "src", "width", "height", 4, "ngIf"], ["id", "buttons", 3, "hidden"], ["ngBoxButtons", ""], ["class", "title", 4, "ngIf"], ["class", "pages", 4, "ngIf"], ["id", "closeButton", "src", "data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZG\nluZz0idXRmLTgiPz4NCjwhLS0gR2VuZXJhdG9yOiBBZG9iZSBJbGx1c3RyYXRvciAxNS4xLjAsIFNWRyBFeHBvcnQgUGx1Zy1JbiAuIFNWRyBWZXJzaW9uOiA2LjAw\nIEJ1aWxkIDApICAtLT4NCjwhRE9DVFlQRSBzdmcgUFVCTElDICItLy9XM0MvL0RURCBTVkcgMS4xLy9FTiIgImh0dHA6Ly93d3cudzMub3JnL0dyYXBoaWNzL1NWRy\n8xLjEvRFREL3N2ZzExLmR0ZCI+DQo8c3ZnIHZlcnNpb249IjEuMSIgaWQ9IkxheWVyXzEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6\neGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHg9IjBweCIgeT0iMHB4Ig0KCSB3aWR0aD0iMzBweCIgaGVpZ2h0PSIzMHB4IiB2aWV3Qm94PSIwID\nAgMzAgMzAiIGVuYWJsZS1iYWNrZ3JvdW5kPSJuZXcgMCAwIDMwIDMwIiB4bWw6c3BhY2U9InByZXNlcnZlIj4NCjxwb2x5Z29uIGZpbGw9IiNGRkZGRkYiIHN0cm9r\nZT0iIzZCNkI2QiIgc3Ryb2tlLW1pdGVybGltaXQ9IjEwIiBwb2ludHM9IjI4LjUsMi44NCAyNS40NjMsMS41IDE1LDEyLjc0OSA0LjUzOSwxLjUgMS41LDIuODQgDQ\noJMTIuODExLDE1IDEuNSwyNy4xNiA0LjUzOSwyOC41IDE1LDE3LjI1MSAyNS40NjMsMjguNSAyOC41LDI3LjE2IDE3LjE4OSwxNSAiLz4NCjwvc3ZnPg0K", "alt", "", 3, "click"], ["src", "data:image/svg+xml;base64,PD94bWwgdmVyc2lvb\nj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz4NCjwhLS0gR2VuZXJhdG9yOiBBZG9iZSBJbGx1c3RyYXRvciAxNS4xLjAsIFNWRyBFeHBvcnQgUGx1Zy1JbiAuIFNWRyB\nWZXJzaW9uOiA2LjAwIEJ1aWxkIDApICAtLT4NCjwhRE9DVFlQRSBzdmcgUFVCTElDICItLy9XM0MvL0RURCBTVkcgMS4xLy9FTiIgImh0dHA6Ly93d3cudzMub3JnL\n0dyYXBoaWNzL1NWRy8xLjEvRFREL3N2ZzExLmR0ZCI+DQo8c3ZnIHZlcnNpb249IjEuMSIgaWQ9IkxheWVyXzEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDA\nwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHg9IjBweCIgeT0iMHB4Ig0KCSB3aWR0aD0iNzBweCIgaGVpZ2h0PSIxMDBwe\nCIgdmlld0JveD0iMCAwIDcwIDEwMCIgZW5hYmxlLWJhY2tncm91bmQ9Im5ldyAwIDAgNzAgMTAwIiB4bWw6c3BhY2U9InByZXNlcnZlIj4NCjxwb2x5Z29uIGZpbGw\n9IiNGRkZGRkYiIHN0cm9rZT0iIzZCNkI2QiIgc3Ryb2tlLW1pdGVybGltaXQ9IjEwIiBwb2ludHM9IjQ1LjYsOTguNTI0IDE0LjU0NCw1MCA0NS42LDEuNDc2IDQ4L\njgwMSwzLjUyNCAxOS4wNTYsNTAgDQoJNDguODAxLDk2LjQ3NiAiLz4NCjwvc3ZnPg0K", 1, "left", 3, "click"], ["src", "data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0i\nMS4wIiBlbmNvZGluZz0idXRmLTgiPz4NCjwhLS0gR2VuZXJhdG9yOiBBZG9iZSBJbGx1c3RyYXRvciAxNS4xLjAsIFNWRyBFeHBvcnQgUGx1Zy1JbiAuIFNWRyBWZX\nJzaW9uOiA2LjAwIEJ1aWxkIDApICAtLT4NCjwhRE9DVFlQRSBzdmcgUFVCTElDICItLy9XM0MvL0RURCBTVkcgMS4xLy9FTiIgImh0dHA6Ly93d3cudzMub3JnL0dy\nYXBoaWNzL1NWRy8xLjEvRFREL3N2ZzExLmR0ZCI+DQo8c3ZnIHZlcnNpb249IjEuMSIgaWQ9IkxheWVyXzEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3\nN2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHg9IjBweCIgeT0iMHB4Ig0KCSB3aWR0aD0iNzBweCIgaGVpZ2h0PSIxMDBweCIg\ndmlld0JveD0iMCAwIDcwIDEwMCIgZW5hYmxlLWJhY2tncm91bmQ9Im5ldyAwIDAgNzAgMTAwIiB4bWw6c3BhY2U9InByZXNlcnZlIj4NCjxwb2x5Z29uIGZpbGw9Ii\nNGRkZGRkYiIHN0cm9rZT0iIzZCNkI2QiIgc3Ryb2tlLW1pdGVybGltaXQ9IjEwIiBwb2ludHM9IjE3Ljc0Niw5OC41MjQgNDguODAxLDUwIDE3Ljc0NiwxLjQ3NiAx\nNC41NDUsMy41MjQgDQoJNDQuMjg5LDUwIDE0LjU0NSw5Ni40NzYgIi8+DQo8L3N2Zz4NCg==", 1, "right", 3, "click"], ["alt", "", 3, "src", "hidden", "load", "click"], ["ngBoxContent", ""], ["frameborder", "0", "allowfullscreen", "", 3, "src", "width", "height"], ["frameborder", "0", "webkitallowfullscreen", "", "mozallowfullscreen", "", "allowfullscreen", "", 3, "src", "width", "height"], [1, "title"], [1, "pages"]],
    template: function NgBoxComponent_Template(rf, ctx) {
      if (rf & 1) {
        _angular_core__WEBPACK_IMPORTED_MODULE_1__["ɵɵtemplate"](0, NgBoxComponent_div_0_Template, 2, 0, "div", 0);
        _angular_core__WEBPACK_IMPORTED_MODULE_1__["ɵɵtemplate"](1, NgBoxComponent_div_1_Template, 14, 12, "div", 1);
      }
      if (rf & 2) {
        _angular_core__WEBPACK_IMPORTED_MODULE_1__["ɵɵproperty"]("ngIf", ctx.ngBox.loading);
        _angular_core__WEBPACK_IMPORTED_MODULE_1__["ɵɵadvance"](1);
        _angular_core__WEBPACK_IMPORTED_MODULE_1__["ɵɵproperty"]("ngIf", ctx.ngBox.open);
      }
    },
    dependencies: [_angular_common__WEBPACK_IMPORTED_MODULE_2__.NgIf, _angular_common__WEBPACK_IMPORTED_MODULE_2__.NgStyle],
    styles: ["#ngBoxLoading[_ngcontent-%COMP%]{\n            text-align: center;\n            z-index: 10001;\n            width: 100%;\n            height: 100%;\n            color: white;\n            position: fixed;\n            top: 46%;\n            font-size: 20px;\n        }\n        #ngBoxWrapper[_ngcontent-%COMP%] {\n            background-color: rgba(0, 0, 0, 0.9);\n            position: fixed;\n            top: 0px;\n            left: 0px;\n            text-align: center;\n            z-index: 10000;\n            width: 100%;\n            height: 100%;\n        }\n\n        #ngBoxWrapper[_ngcontent-%COMP%]   #ngBoxContent[_ngcontent-%COMP%]   img[_ngcontent-%COMP%] {\n            border-radius: 4px;\n        }\n\n        #ngBoxContent[_ngcontent-%COMP%] {\n            display: block;\n        }\n\n        button[_ngcontent-%COMP%] {\n            font-size: 12px;\n        }\n\n        iframe[_ngcontent-%COMP%] {\n            max-width: 100%;\n            max-height: 100%;\n        }\n        #buttons[_ngcontent-%COMP%]{\n            position: relative;\n            margin: 5px auto;\n            text-align: right;\n        }\n        #buttons[_ngcontent-%COMP%]   p[_ngcontent-%COMP%]{\n            float: left;\n            color: white;\n            text-align: left;\n            margin: 0 50px 0 0;\n            font-size: 12px;\n            font-family: sans-serif;\n        }\n        #buttons[_ngcontent-%COMP%]   span.title[_ngcontent-%COMP%]{\n            display: block;\n            height: 18px;\n            overflow: hidden;\n        }\n        #closeButton[_ngcontent-%COMP%]{\n            position: absolute;\n            top: 0px;\n            right: 0px;\n            cursor: pointer;\n        }\n        .left[_ngcontent-%COMP%]{\n            position: fixed;\n            left: -5px;\n            margin-top: -42px;\n            cursor: pointer;\n            top: 50%;\n        }\n        .right[_ngcontent-%COMP%]{\n            position: fixed;\n            right: -10px;\n            margin-top: -42px;\n            cursor: pointer;\n            top: 50%;\n        }\n/*# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8uL3NyYy9hcHAvbmdib3gvbmdib3guY29tcG9uZW50LnRzIl0sIm5hbWVzIjpbXSwibWFwcGluZ3MiOiI7UUFDUTtZQUNJLGtCQUFrQjtZQUNsQixjQUFjO1lBQ2QsV0FBVztZQUNYLFlBQVk7WUFDWixZQUFZO1lBQ1osZUFBZTtZQUNmLFFBQVE7WUFDUixlQUFlO1FBQ25CO1FBQ0E7WUFDSSxvQ0FBb0M7WUFDcEMsZUFBZTtZQUNmLFFBQVE7WUFDUixTQUFTO1lBQ1Qsa0JBQWtCO1lBQ2xCLGNBQWM7WUFDZCxXQUFXO1lBQ1gsWUFBWTtRQUNoQjs7UUFFQTtZQUdJLGtCQUFrQjtRQUN0Qjs7UUFFQTtZQUNJLGNBQWM7UUFDbEI7O1FBRUE7WUFDSSxlQUFlO1FBQ25COztRQUVBO1lBQ0ksZUFBZTtZQUNmLGdCQUFnQjtRQUNwQjtRQUNBO1lBQ0ksa0JBQWtCO1lBQ2xCLGdCQUFnQjtZQUNoQixpQkFBaUI7UUFDckI7UUFDQTtZQUNJLFdBQVc7WUFDWCxZQUFZO1lBQ1osZ0JBQWdCO1lBQ2hCLGtCQUFrQjtZQUNsQixlQUFlO1lBQ2YsdUJBQXVCO1FBQzNCO1FBQ0E7WUFDSSxjQUFjO1lBQ2QsWUFBWTtZQUNaLGdCQUFnQjtRQUNwQjtRQUNBO1lBQ0ksa0JBQWtCO1lBQ2xCLFFBQVE7WUFDUixVQUFVO1lBQ1YsZUFBZTtRQUNuQjtRQUNBO1lBQ0ksZUFBZTtZQUNmLFVBQVU7WUFDVixpQkFBaUI7WUFDakIsZUFBZTtZQUNmLFFBQVE7UUFDWjtRQUNBO1lBQ0ksZUFBZTtZQUNmLFlBQVk7WUFDWixpQkFBaUI7WUFDakIsZUFBZTtZQUNmLFFBQVE7UUFDWiIsInNvdXJjZXNDb250ZW50IjpbIlxuICAgICAgICAjbmdCb3hMb2FkaW5ne1xuICAgICAgICAgICAgdGV4dC1hbGlnbjogY2VudGVyO1xuICAgICAgICAgICAgei1pbmRleDogMTAwMDE7XG4gICAgICAgICAgICB3aWR0aDogMTAwJTtcbiAgICAgICAgICAgIGhlaWdodDogMTAwJTtcbiAgICAgICAgICAgIGNvbG9yOiB3aGl0ZTtcbiAgICAgICAgICAgIHBvc2l0aW9uOiBmaXhlZDtcbiAgICAgICAgICAgIHRvcDogNDYlO1xuICAgICAgICAgICAgZm9udC1zaXplOiAyMHB4O1xuICAgICAgICB9XG4gICAgICAgICNuZ0JveFdyYXBwZXIge1xuICAgICAgICAgICAgYmFja2dyb3VuZC1jb2xvcjogcmdiYSgwLCAwLCAwLCAwLjkpO1xuICAgICAgICAgICAgcG9zaXRpb246IGZpeGVkO1xuICAgICAgICAgICAgdG9wOiAwcHg7XG4gICAgICAgICAgICBsZWZ0OiAwcHg7XG4gICAgICAgICAgICB0ZXh0LWFsaWduOiBjZW50ZXI7XG4gICAgICAgICAgICB6LWluZGV4OiAxMDAwMDtcbiAgICAgICAgICAgIHdpZHRoOiAxMDAlO1xuICAgICAgICAgICAgaGVpZ2h0OiAxMDAlO1xuICAgICAgICB9XG5cbiAgICAgICAgI25nQm94V3JhcHBlciAjbmdCb3hDb250ZW50IGltZyB7XG4gICAgICAgICAgICAtd2Via2l0LWJvcmRlci1yYWRpdXM6IDRweDtcbiAgICAgICAgICAgIC1tb3otYm9yZGVyLXJhZGl1czogNHB4O1xuICAgICAgICAgICAgYm9yZGVyLXJhZGl1czogNHB4O1xuICAgICAgICB9XG5cbiAgICAgICAgI25nQm94Q29udGVudCB7XG4gICAgICAgICAgICBkaXNwbGF5OiBibG9jaztcbiAgICAgICAgfVxuXG4gICAgICAgIGJ1dHRvbiB7XG4gICAgICAgICAgICBmb250LXNpemU6IDEycHg7XG4gICAgICAgIH1cblxuICAgICAgICBpZnJhbWUge1xuICAgICAgICAgICAgbWF4LXdpZHRoOiAxMDAlO1xuICAgICAgICAgICAgbWF4LWhlaWdodDogMTAwJTtcbiAgICAgICAgfVxuICAgICAgICAjYnV0dG9uc3tcbiAgICAgICAgICAgIHBvc2l0aW9uOiByZWxhdGl2ZTtcbiAgICAgICAgICAgIG1hcmdpbjogNXB4IGF1dG87XG4gICAgICAgICAgICB0ZXh0LWFsaWduOiByaWdodDtcbiAgICAgICAgfVxuICAgICAgICAjYnV0dG9ucyBwe1xuICAgICAgICAgICAgZmxvYXQ6IGxlZnQ7XG4gICAgICAgICAgICBjb2xvcjogd2hpdGU7XG4gICAgICAgICAgICB0ZXh0LWFsaWduOiBsZWZ0O1xuICAgICAgICAgICAgbWFyZ2luOiAwIDUwcHggMCAwO1xuICAgICAgICAgICAgZm9udC1zaXplOiAxMnB4O1xuICAgICAgICAgICAgZm9udC1mYW1pbHk6IHNhbnMtc2VyaWY7XG4gICAgICAgIH1cbiAgICAgICAgI2J1dHRvbnMgc3Bhbi50aXRsZXtcbiAgICAgICAgICAgIGRpc3BsYXk6IGJsb2NrO1xuICAgICAgICAgICAgaGVpZ2h0OiAxOHB4O1xuICAgICAgICAgICAgb3ZlcmZsb3c6IGhpZGRlbjtcbiAgICAgICAgfVxuICAgICAgICAjY2xvc2VCdXR0b257XG4gICAgICAgICAgICBwb3NpdGlvbjogYWJzb2x1dGU7XG4gICAgICAgICAgICB0b3A6IDBweDtcbiAgICAgICAgICAgIHJpZ2h0OiAwcHg7XG4gICAgICAgICAgICBjdXJzb3I6IHBvaW50ZXI7XG4gICAgICAgIH1cbiAgICAgICAgLmxlZnR7XG4gICAgICAgICAgICBwb3NpdGlvbjogZml4ZWQ7XG4gICAgICAgICAgICBsZWZ0OiAtNXB4O1xuICAgICAgICAgICAgbWFyZ2luLXRvcDogLTQycHg7XG4gICAgICAgICAgICBjdXJzb3I6IHBvaW50ZXI7XG4gICAgICAgICAgICB0b3A6IDUwJTtcbiAgICAgICAgfVxuICAgICAgICAucmlnaHR7XG4gICAgICAgICAgICBwb3NpdGlvbjogZml4ZWQ7XG4gICAgICAgICAgICByaWdodDogLTEwcHg7XG4gICAgICAgICAgICBtYXJnaW4tdG9wOiAtNDJweDtcbiAgICAgICAgICAgIGN1cnNvcjogcG9pbnRlcjtcbiAgICAgICAgICAgIHRvcDogNTAlO1xuICAgICAgICB9XG4gICAgIl0sInNvdXJjZVJvb3QiOiIifQ== */"]
  });
}

/***/ }),

/***/ 4126:
/*!******************************************!*\
  !*** ./src/app/ngbox/ngbox.directive.ts ***!
  \******************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "NgBoxDirective": () => (/* binding */ NgBoxDirective)
/* harmony export */ });
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @angular/core */ 2560);
/* harmony import */ var _ngbox_service__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./ngbox.service */ 1571);
/* harmony import */ var _angular_platform_browser__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @angular/platform-browser */ 4497);



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
    let pos = this.ngBox.images.map(function (e) {
      return e.id;
    }).indexOf(this.id);
    if (pos !== -1) this.ngBox.images.splice(pos, 1);
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
        new Image().src = url;
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
  static #_ = this.ɵfac = function NgBoxDirective_Factory(t) {
    return new (t || NgBoxDirective)(_angular_core__WEBPACK_IMPORTED_MODULE_1__["ɵɵdirectiveInject"](_ngbox_service__WEBPACK_IMPORTED_MODULE_0__.NgBoxService), _angular_core__WEBPACK_IMPORTED_MODULE_1__["ɵɵdirectiveInject"](_angular_platform_browser__WEBPACK_IMPORTED_MODULE_2__.DomSanitizer));
  };
  static #_2 = this.ɵdir = /*@__PURE__*/_angular_core__WEBPACK_IMPORTED_MODULE_1__["ɵɵdefineDirective"]({
    type: NgBoxDirective,
    selectors: [["", "myNgBox", ""], ["", "ng-box", ""]],
    hostBindings: function NgBoxDirective_HostBindings(rf, ctx) {
      if (rf & 1) {
        _angular_core__WEBPACK_IMPORTED_MODULE_1__["ɵɵlistener"]("click", function NgBoxDirective_click_HostBindingHandler($event) {
          return ctx.onClick($event);
        });
      }
    },
    inputs: {
      src: "src",
      href: "href",
      title: "title",
      width: "width",
      height: "height",
      group: "group",
      cache: "cache",
      image: "image"
    }
  });
}

/***/ }),

/***/ 1571:
/*!****************************************!*\
  !*** ./src/app/ngbox/ngbox.service.ts ***!
  \****************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "NgBoxService": () => (/* binding */ NgBoxService)
/* harmony export */ });
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @angular/core */ 2560);

class NgBoxService {
  constructor() {
    this.id = 0;
    this.loading = false;
    this.open = false;
    this.images = [];
  }
  static #_ = this.ɵfac = function NgBoxService_Factory(t) {
    return new (t || NgBoxService)();
  };
  static #_2 = this.ɵprov = /*@__PURE__*/_angular_core__WEBPACK_IMPORTED_MODULE_0__["ɵɵdefineInjectable"]({
    token: NgBoxService,
    factory: NgBoxService.ɵfac
  });
}

/***/ }),

/***/ 3276:
/*!**************************************************************!*\
  !*** ./src/app/pages/gallery-page/gallery-page.component.ts ***!
  \**************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "GalleryPageComponent": () => (/* binding */ GalleryPageComponent)
/* harmony export */ });
/* harmony import */ var _gallery_state_gallery_action__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../../gallery/state/gallery.action */ 2868);
/* harmony import */ var _state_app_action__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../../state/app.action */ 6641);
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! @angular/core */ 2560);
/* harmony import */ var _angular_router__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(/*! @angular/router */ 124);
/* harmony import */ var _ngrx_store__WEBPACK_IMPORTED_MODULE_8__ = __webpack_require__(/*! @ngrx/store */ 3488);
/* harmony import */ var _angular_common__WEBPACK_IMPORTED_MODULE_9__ = __webpack_require__(/*! @angular/common */ 4666);
/* harmony import */ var _gallery_gallery_list_gallery_list_component__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../gallery/gallery-list/gallery-list.component */ 8072);
/* harmony import */ var _gallery_gallery_info_gallery_info_component__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../../gallery/gallery-info/gallery-info.component */ 7022);
/* harmony import */ var _gallery_gallery_toolbar_gallery_toolbar_component__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ../../gallery/gallery-toolbar/gallery-toolbar.component */ 5923);
/* harmony import */ var _image_image_list_image_list_component__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! ../../image/image-list/image-list.component */ 3128);










function GalleryPageComponent_div_0_Template(rf, ctx) {
  if (rf & 1) {
    _angular_core__WEBPACK_IMPORTED_MODULE_6__["ɵɵelementStart"](0, "div");
    _angular_core__WEBPACK_IMPORTED_MODULE_6__["ɵɵelement"](1, "gallery-toolbar", 1);
    _angular_core__WEBPACK_IMPORTED_MODULE_6__["ɵɵelementStart"](2, "div", 2);
    _angular_core__WEBPACK_IMPORTED_MODULE_6__["ɵɵtext"](3);
    _angular_core__WEBPACK_IMPORTED_MODULE_6__["ɵɵpipe"](4, "json");
    _angular_core__WEBPACK_IMPORTED_MODULE_6__["ɵɵelementEnd"]()();
  }
  if (rf & 2) {
    const gallery_r1 = ctx.ngIf;
    _angular_core__WEBPACK_IMPORTED_MODULE_6__["ɵɵadvance"](1);
    _angular_core__WEBPACK_IMPORTED_MODULE_6__["ɵɵproperty"]("gallery", gallery_r1);
    _angular_core__WEBPACK_IMPORTED_MODULE_6__["ɵɵadvance"](2);
    _angular_core__WEBPACK_IMPORTED_MODULE_6__["ɵɵtextInterpolate1"](" [", _angular_core__WEBPACK_IMPORTED_MODULE_6__["ɵɵpipeBind1"](4, 2, gallery_r1), "] ");
  }
}
class GalleryPageComponent {
  constructor(route, galleryStore, rootStore) {
    this.route = route;
    this.galleryStore = galleryStore;
    this.rootStore = rootStore;
    this.id = 0;
  }
  ngOnInit() {
    this.route.params.subscribe(params => {
      this.id = params.gallery_id;
      this.galleryStore.dispatch((0,_gallery_state_gallery_action__WEBPACK_IMPORTED_MODULE_0__.loadGalleryAction)({
        id: this.id
      }));
      this.rootStore.dispatch((0,_state_app_action__WEBPACK_IMPORTED_MODULE_1__.loadOtherDataAction)());
    });
  }
  static #_ = this.ɵfac = function GalleryPageComponent_Factory(t) {
    return new (t || GalleryPageComponent)(_angular_core__WEBPACK_IMPORTED_MODULE_6__["ɵɵdirectiveInject"](_angular_router__WEBPACK_IMPORTED_MODULE_7__.ActivatedRoute), _angular_core__WEBPACK_IMPORTED_MODULE_6__["ɵɵdirectiveInject"](_ngrx_store__WEBPACK_IMPORTED_MODULE_8__.Store), _angular_core__WEBPACK_IMPORTED_MODULE_6__["ɵɵdirectiveInject"](_ngrx_store__WEBPACK_IMPORTED_MODULE_8__.Store));
  };
  static #_2 = this.ɵcmp = /*@__PURE__*/_angular_core__WEBPACK_IMPORTED_MODULE_6__["ɵɵdefineComponent"]({
    type: GalleryPageComponent,
    selectors: [["gallery-page"]],
    decls: 5,
    vars: 3,
    consts: [[4, "ngIf"], [3, "gallery"], [1, "course"]],
    template: function GalleryPageComponent_Template(rf, ctx) {
      if (rf & 1) {
        _angular_core__WEBPACK_IMPORTED_MODULE_6__["ɵɵtemplate"](0, GalleryPageComponent_div_0_Template, 5, 4, "div", 0);
        _angular_core__WEBPACK_IMPORTED_MODULE_6__["ɵɵpipe"](1, "async");
        _angular_core__WEBPACK_IMPORTED_MODULE_6__["ɵɵelement"](2, "gallery-info")(3, "gallery-list")(4, "image-list");
      }
      if (rf & 2) {
        _angular_core__WEBPACK_IMPORTED_MODULE_6__["ɵɵproperty"]("ngIf", _angular_core__WEBPACK_IMPORTED_MODULE_6__["ɵɵpipeBind1"](1, 1, ctx.gallery$));
      }
    },
    dependencies: [_angular_common__WEBPACK_IMPORTED_MODULE_9__.NgIf, _gallery_gallery_list_gallery_list_component__WEBPACK_IMPORTED_MODULE_2__.GalleryListComponent, _gallery_gallery_info_gallery_info_component__WEBPACK_IMPORTED_MODULE_3__.GalleryInfoComponent, _gallery_gallery_toolbar_gallery_toolbar_component__WEBPACK_IMPORTED_MODULE_4__.GalleryToolbarComponent, _image_image_list_image_list_component__WEBPACK_IMPORTED_MODULE_5__.ImageListComponent, _angular_common__WEBPACK_IMPORTED_MODULE_9__.AsyncPipe, _angular_common__WEBPACK_IMPORTED_MODULE_9__.JsonPipe],
    styles: ["\n/*# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbXSwibmFtZXMiOltdLCJtYXBwaW5ncyI6IiIsInNvdXJjZVJvb3QiOiIifQ== */"]
  });
}

/***/ }),

/***/ 8043:
/*!********************************************************!*\
  !*** ./src/app/pages/home-page/home-page.component.ts ***!
  \********************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "HomePageComponent": () => (/* binding */ HomePageComponent)
/* harmony export */ });
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @angular/core */ 2560);
/* harmony import */ var _services_page_data_service__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../../services/page_data.service */ 5914);
/* harmony import */ var _gallery_gallery_list_gallery_list_component__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../../gallery/gallery-list/gallery-list.component */ 8072);
/* harmony import */ var _home_home_toolbar_home_toolbar_component__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../home/home-toolbar/home-toolbar.component */ 5434);




class HomePageComponent {
  constructor(page_data_service) {
    this.page_data_service = page_data_service;
  }
  ngOnInit() {
    this.page_data_service.GetHomePageData();
  }
  static #_ = this.ɵfac = function HomePageComponent_Factory(t) {
    return new (t || HomePageComponent)(_angular_core__WEBPACK_IMPORTED_MODULE_3__["ɵɵdirectiveInject"](_services_page_data_service__WEBPACK_IMPORTED_MODULE_0__.PageDataService));
  };
  static #_2 = this.ɵcmp = /*@__PURE__*/_angular_core__WEBPACK_IMPORTED_MODULE_3__["ɵɵdefineComponent"]({
    type: HomePageComponent,
    selectors: [["moa"]],
    decls: 2,
    vars: 0,
    template: function HomePageComponent_Template(rf, ctx) {
      if (rf & 1) {
        _angular_core__WEBPACK_IMPORTED_MODULE_3__["ɵɵelement"](0, "home-toolbar")(1, "gallery-list");
      }
    },
    dependencies: [_gallery_gallery_list_gallery_list_component__WEBPACK_IMPORTED_MODULE_1__.GalleryListComponent, _home_home_toolbar_home_toolbar_component__WEBPACK_IMPORTED_MODULE_2__.HomeToolbarComponent],
    styles: ["\n/*# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbXSwibmFtZXMiOltdLCJtYXBwaW5ncyI6IiIsInNvdXJjZVJvb3QiOiIifQ== */"]
  });
}

/***/ }),

/***/ 2141:
/*!**********************************************************!*\
  !*** ./src/app/pages/image-page/image-page.component.ts ***!
  \**********************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "ImagePageComponent": () => (/* binding */ ImagePageComponent)
/* harmony export */ });
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @angular/core */ 2560);
/* harmony import */ var _angular_router__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! @angular/router */ 124);
/* harmony import */ var _services_page_data_service__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../../services/page_data.service */ 5914);
/* harmony import */ var _image_image_info_image_info_component__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../../image/image-info/image-info.component */ 386);
/* harmony import */ var _image_image_toolbar_image_toolbar_component__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../image/image-toolbar/image-toolbar.component */ 9458);





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
  static #_ = this.ɵfac = function ImagePageComponent_Factory(t) {
    return new (t || ImagePageComponent)(_angular_core__WEBPACK_IMPORTED_MODULE_3__["ɵɵdirectiveInject"](_angular_router__WEBPACK_IMPORTED_MODULE_4__.ActivatedRoute), _angular_core__WEBPACK_IMPORTED_MODULE_3__["ɵɵdirectiveInject"](_services_page_data_service__WEBPACK_IMPORTED_MODULE_0__.PageDataService));
  };
  static #_2 = this.ɵcmp = /*@__PURE__*/_angular_core__WEBPACK_IMPORTED_MODULE_3__["ɵɵdefineComponent"]({
    type: ImagePageComponent,
    selectors: [["image-page"]],
    decls: 2,
    vars: 0,
    template: function ImagePageComponent_Template(rf, ctx) {
      if (rf & 1) {
        _angular_core__WEBPACK_IMPORTED_MODULE_3__["ɵɵelement"](0, "image-toolbar")(1, "image-info");
      }
    },
    dependencies: [_image_image_info_image_info_component__WEBPACK_IMPORTED_MODULE_1__.ImageInfoComponent, _image_image_toolbar_image_toolbar_component__WEBPACK_IMPORTED_MODULE_2__.ImageToolbarComponent],
    styles: ["\n/*# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbXSwibmFtZXMiOltdLCJtYXBwaW5ncyI6IiIsInNvdXJjZVJvb3QiOiIifQ== */"]
  });
}

/***/ }),

/***/ 1697:
/*!***********************************!*\
  !*** ./src/app/reducers/index.ts ***!
  \***********************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "logger": () => (/* binding */ logger),
/* harmony export */   "metaReducers": () => (/* binding */ metaReducers),
/* harmony export */   "reducers": () => (/* binding */ reducers)
/* harmony export */ });
/* harmony import */ var _environments_environment__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../../environments/environment */ 2340);
/* harmony import */ var _ngrx_router_store__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @ngrx/router-store */ 1611);
/* harmony import */ var _state_app_reducer__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../state/app.reducer */ 5103);



const reducers = {
  router: _ngrx_router_store__WEBPACK_IMPORTED_MODULE_2__.routerReducer,
  app: _state_app_reducer__WEBPACK_IMPORTED_MODULE_1__.AppReducer
};
function logger(reducer) {
  return (state, action) => {
    //console.log("state before: ", state);
    //console.log("action", action);
    return reducer(state, action);
  };
}
const metaReducers = !_environments_environment__WEBPACK_IMPORTED_MODULE_0__.environment.production ? [logger] : [];

/***/ }),

/***/ 4872:
/*!**************************************************!*\
  !*** ./src/app/services/button-click.service.ts ***!
  \**************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "ButtonClickService": () => (/* binding */ ButtonClickService)
/* harmony export */ });
/* harmony import */ var rxjs__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! rxjs */ 2218);
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @angular/core */ 2560);


class ButtonClickService {
  constructor() {
    this.notify = new rxjs__WEBPACK_IMPORTED_MODULE_0__.Subject();
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
  static #_ = this.ɵfac = function ButtonClickService_Factory(t) {
    return new (t || ButtonClickService)();
  };
  static #_2 = this.ɵprov = /*@__PURE__*/_angular_core__WEBPACK_IMPORTED_MODULE_1__["ɵɵdefineInjectable"]({
    token: ButtonClickService,
    factory: ButtonClickService.ɵfac
  });
}

/***/ }),

/***/ 2468:
/*!******************************************!*\
  !*** ./src/app/services/data.service.ts ***!
  \******************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "DataService": () => (/* binding */ DataService)
/* harmony export */ });
/* harmony import */ var rxjs__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! rxjs */ 4505);
/* harmony import */ var rxjs_add_operator_map__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! rxjs/add/operator/map */ 9464);
/* harmony import */ var rxjs_add_operator_filter__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! rxjs/add/operator/filter */ 1796);
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @angular/core */ 2560);
/* harmony import */ var _angular_common_http__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! @angular/common/http */ 8987);





class DataService {
  constructor(http) {
    this.http = http;
    this.data = new rxjs__WEBPACK_IMPORTED_MODULE_2__.BehaviorSubject([]);
  }
  setPageData(pageData) {
    this.data.next(pageData);
  }
  getBreadcrumbObserver() {
    return this.data.map(data => {
      return data.breadcrumbs;
    }).filter(data => data !== undefined);
  }
  getGalleriesObserver() {
    return this.data.map(data => {
      return data.galleries;
    }).filter(data => data !== undefined);
  }
  getGalleryObserver() {
    return this.data.map(data => {
      // TODO: Convert to Gallery model?
      return data.gallery;
    }).filter(data => data !== undefined);
  }
  getImageObserver() {
    return this.data.map(data => {
      // TODO: Convert to Image model?
      return data.image;
    }).filter(data => data !== undefined);
  }
  getImagesObserver() {
    return this.data.map(data => {
      return data.images;
    }).filter(data => data !== undefined);
  }
  getPageTitleObserver() {
    return this.data.map(data => {
      return data.page_title;
    }).filter(data => data !== undefined);
  }
  static #_ = this.ɵfac = function DataService_Factory(t) {
    return new (t || DataService)(_angular_core__WEBPACK_IMPORTED_MODULE_3__["ɵɵinject"](_angular_common_http__WEBPACK_IMPORTED_MODULE_4__.HttpClient));
  };
  static #_2 = this.ɵprov = /*@__PURE__*/_angular_core__WEBPACK_IMPORTED_MODULE_3__["ɵɵdefineInjectable"]({
    token: DataService,
    factory: DataService.ɵfac
  });
}

/***/ }),

/***/ 5914:
/*!***********************************************!*\
  !*** ./src/app/services/page_data.service.ts ***!
  \***********************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "PageDataService": () => (/* binding */ PageDataService)
/* harmony export */ });
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @angular/core */ 2560);
/* harmony import */ var _data_service__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./data.service */ 2468);
/* harmony import */ var _angular_common_http__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @angular/common/http */ 8987);



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
  GetImagePageData(image_id, gallery_id) {
    let url = this.api_url + 'image_page/' + gallery_id + '/' + image_id;
    this.GetPageData(url);
  }
  static #_ = this.ɵfac = function PageDataService_Factory(t) {
    return new (t || PageDataService)(_angular_core__WEBPACK_IMPORTED_MODULE_1__["ɵɵinject"](_data_service__WEBPACK_IMPORTED_MODULE_0__.DataService), _angular_core__WEBPACK_IMPORTED_MODULE_1__["ɵɵinject"](_angular_common_http__WEBPACK_IMPORTED_MODULE_2__.HttpClient));
  };
  static #_2 = this.ɵprov = /*@__PURE__*/_angular_core__WEBPACK_IMPORTED_MODULE_1__["ɵɵdefineInjectable"]({
    token: PageDataService,
    factory: PageDataService.ɵfac
  });
}

/***/ }),

/***/ 3279:
/*!************************************************!*\
  !*** ./src/app/services/page_title.service.ts ***!
  \************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "PageTitleService": () => (/* binding */ PageTitleService)
/* harmony export */ });
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @angular/core */ 2560);
/* harmony import */ var _data_service__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./data.service */ 2468);


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
  static #_ = this.ɵfac = function PageTitleService_Factory(t) {
    return new (t || PageTitleService)(_angular_core__WEBPACK_IMPORTED_MODULE_1__["ɵɵinject"](_data_service__WEBPACK_IMPORTED_MODULE_0__.DataService));
  };
  static #_2 = this.ɵprov = /*@__PURE__*/_angular_core__WEBPACK_IMPORTED_MODULE_1__["ɵɵdefineInjectable"]({
    token: PageTitleService,
    factory: PageTitleService.ɵfac
  });
}

/***/ }),

/***/ 2889:
/*!***********************************************************!*\
  !*** ./src/app/services/simple_gallery-entity.service.ts ***!
  \***********************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "SimpleGalleryEntityService": () => (/* binding */ SimpleGalleryEntityService)
/* harmony export */ });
/* harmony import */ var _ngrx_data__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @ngrx/data */ 781);
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @angular/core */ 2560);



class SimpleGalleryEntityService extends _ngrx_data__WEBPACK_IMPORTED_MODULE_0__.EntityCollectionServiceBase {
  constructor(serviceElementsFactory) {
    super('SimpleGallery', serviceElementsFactory);
  }
  static #_ = this.ɵfac = function SimpleGalleryEntityService_Factory(t) {
    return new (t || SimpleGalleryEntityService)(_angular_core__WEBPACK_IMPORTED_MODULE_1__["ɵɵinject"](_ngrx_data__WEBPACK_IMPORTED_MODULE_0__.EntityCollectionServiceElementsFactory));
  };
  static #_2 = this.ɵprov = /*@__PURE__*/_angular_core__WEBPACK_IMPORTED_MODULE_1__["ɵɵdefineInjectable"]({
    token: SimpleGalleryEntityService,
    factory: SimpleGalleryEntityService.ɵfac
  });
}

/***/ }),

/***/ 5599:
/*!*********************************************************!*\
  !*** ./src/app/services/simple_gallery.data.service.ts ***!
  \*********************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "SimpleGalleryDataService": () => (/* binding */ SimpleGalleryDataService)
/* harmony export */ });
/* harmony import */ var _ngrx_data__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @ngrx/data */ 781);
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @angular/core */ 2560);
/* harmony import */ var _angular_common_http__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @angular/common/http */ 8987);




class SimpleGalleryDataService extends _ngrx_data__WEBPACK_IMPORTED_MODULE_0__.DefaultDataService {
  constructor(http, httpUrlGenerator) {
    super('SimpleGallery', http, httpUrlGenerator);
  }
  static #_ = this.ɵfac = function SimpleGalleryDataService_Factory(t) {
    return new (t || SimpleGalleryDataService)(_angular_core__WEBPACK_IMPORTED_MODULE_1__["ɵɵinject"](_angular_common_http__WEBPACK_IMPORTED_MODULE_2__.HttpClient), _angular_core__WEBPACK_IMPORTED_MODULE_1__["ɵɵinject"](_ngrx_data__WEBPACK_IMPORTED_MODULE_0__.HttpUrlGenerator));
  };
  static #_2 = this.ɵprov = /*@__PURE__*/_angular_core__WEBPACK_IMPORTED_MODULE_1__["ɵɵdefineInjectable"]({
    token: SimpleGalleryDataService,
    factory: SimpleGalleryDataService.ɵfac
  });
}

/***/ }),

/***/ 4204:
/*!***********************************************!*\
  !*** ./src/app/services/thumbnail.service.ts ***!
  \***********************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "ThumbnailService": () => (/* binding */ ThumbnailService)
/* harmony export */ });
/* harmony import */ var rxjs__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! rxjs */ 2218);
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @angular/core */ 2560);
/* harmony import */ var _angular_common_http__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @angular/common/http */ 8987);



class ThumbnailService {
  constructor(http) {
    this.http = http;
    this.api_url = '/api/thumbnail_status';
  }
  getStatus(data = null) {
    let subject = new rxjs__WEBPACK_IMPORTED_MODULE_0__.Subject();
    let params = data.join(',');
    let url = this.api_url + '?images=' + params;
    this.http.get(url).subscribe(data => {
      subject.next(data);
    });
    return subject.asObservable();
  }
  static #_ = this.ɵfac = function ThumbnailService_Factory(t) {
    return new (t || ThumbnailService)(_angular_core__WEBPACK_IMPORTED_MODULE_1__["ɵɵinject"](_angular_common_http__WEBPACK_IMPORTED_MODULE_2__.HttpClient));
  };
  static #_2 = this.ɵprov = /*@__PURE__*/_angular_core__WEBPACK_IMPORTED_MODULE_1__["ɵɵdefineInjectable"]({
    token: ThumbnailService,
    factory: ThumbnailService.ɵfac
  });
}

/***/ }),

/***/ 6641:
/*!*************************************!*\
  !*** ./src/app/state/app.action.ts ***!
  \*************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "loadOtherDataAction": () => (/* binding */ loadOtherDataAction),
/* harmony export */   "otherDataLoadedAction": () => (/* binding */ otherDataLoadedAction)
/* harmony export */ });
/* harmony import */ var _ngrx_store__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @ngrx/store */ 3488);

const loadOtherDataAction = (0,_ngrx_store__WEBPACK_IMPORTED_MODULE_0__.createAction)('[Root] Load other data');
const otherDataLoadedAction = (0,_ngrx_store__WEBPACK_IMPORTED_MODULE_0__.createAction)('[Root] Other data loaded', (0,_ngrx_store__WEBPACK_IMPORTED_MODULE_0__.props)());

/***/ }),

/***/ 2297:
/*!*************************************!*\
  !*** ./src/app/state/app.effect.ts ***!
  \*************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "AppEffect": () => (/* binding */ AppEffect)
/* harmony export */ });
/* harmony import */ var _ngrx_effects__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @ngrx/effects */ 5405);
/* harmony import */ var _app_action__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./app.action */ 6641);
/* harmony import */ var rxjs_operators__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! rxjs/operators */ 522);
/* harmony import */ var rxjs_operators__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! rxjs/operators */ 6942);
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! @angular/core */ 2560);
/* harmony import */ var _app_service__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../app.service */ 900);






class AppEffect {
  constructor(actions$, appService) {
    this.actions$ = actions$;
    this.appService = appService;
    this.loadOtherData$ = (0,_ngrx_effects__WEBPACK_IMPORTED_MODULE_2__.createEffect)(() => {
      return this.actions$.pipe((0,_ngrx_effects__WEBPACK_IMPORTED_MODULE_2__.ofType)(_app_action__WEBPACK_IMPORTED_MODULE_0__.loadOtherDataAction), (0,rxjs_operators__WEBPACK_IMPORTED_MODULE_3__.mergeMap)(() => {
        return this.appService.getOtherData().pipe((0,rxjs_operators__WEBPACK_IMPORTED_MODULE_4__.map)(data => {
          return _app_action__WEBPACK_IMPORTED_MODULE_0__.otherDataLoadedAction({
            galleries: data.galleries,
            tags: data.tags
          });
        }));
      }));
    });
  }
  static #_ = this.ɵfac = function AppEffect_Factory(t) {
    return new (t || AppEffect)(_angular_core__WEBPACK_IMPORTED_MODULE_5__["ɵɵinject"](_ngrx_effects__WEBPACK_IMPORTED_MODULE_2__.Actions), _angular_core__WEBPACK_IMPORTED_MODULE_5__["ɵɵinject"](_app_service__WEBPACK_IMPORTED_MODULE_1__.AppService));
  };
  static #_2 = this.ɵprov = /*@__PURE__*/_angular_core__WEBPACK_IMPORTED_MODULE_5__["ɵɵdefineInjectable"]({
    token: AppEffect,
    factory: AppEffect.ɵfac
  });
}

/***/ }),

/***/ 5103:
/*!**************************************!*\
  !*** ./src/app/state/app.reducer.ts ***!
  \**************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "AppReducer": () => (/* binding */ AppReducer)
/* harmony export */ });
/* harmony import */ var _ngrx_store__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @ngrx/store */ 3488);
/* harmony import */ var _app_action__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./app.action */ 6641);


const initialState = {
  galleries: [],
  tags: []
};
const AppReducer = (0,_ngrx_store__WEBPACK_IMPORTED_MODULE_1__.createReducer)(initialState, (0,_ngrx_store__WEBPACK_IMPORTED_MODULE_1__.on)(_app_action__WEBPACK_IMPORTED_MODULE_0__.otherDataLoadedAction, (state, data) => {
  var val = {
    galleries: {
      ...state.galleries
    },
    tags: {
      ...state.tags
    }
  };
  val.galleries = {
    ...data.galleries
  };
  val.tags = {
    ...data.tags
  };
  return val;
}));

/***/ }),

/***/ 6614:
/*!***************************************!*\
  !*** ./src/app/state/app.selector.ts ***!
  \***************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "galleriesFeature": () => (/* binding */ galleriesFeature),
/* harmony export */   "getSubGalleries": () => (/* binding */ getSubGalleries)
/* harmony export */ });
/* harmony import */ var _ngrx_store__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @ngrx/store */ 3488);

const galleriesFeature = state => state.app.galleries;
const getSubGalleries = props => (0,_ngrx_store__WEBPACK_IMPORTED_MODULE_0__.createSelector)(galleriesFeature, galleries => {
  if (galleries === undefined) return [];
  let subGalleries = [];
  let k;
  for (k in galleries) {
    let gallery = galleries[k];
    if (gallery.parentId == props.id) subGalleries.push(gallery);
  }
  return subGalleries;
});

/***/ }),

/***/ 2340:
/*!*****************************************!*\
  !*** ./src/environments/environment.ts ***!
  \*****************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "environment": () => (/* binding */ environment)
/* harmony export */ });
// The file contents for the current environment will overwrite these during build.
// The build system defaults to the dev environment which uses `environment.ts`, but if you do
// `ng build --env=prod` then `environment.prod.ts` will be used instead.
// The list of which env maps to which file can be found in `.angular-cli.json`.
const environment = {
  production: false
};

/***/ }),

/***/ 4431:
/*!*********************!*\
  !*** ./src/main.ts ***!
  \*********************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _angular_platform_browser__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @angular/platform-browser */ 4497);
/* harmony import */ var _angular_core__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @angular/core */ 2560);
/* harmony import */ var _app_app_module__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./app/app.module */ 6747);
/* harmony import */ var _environments_environment__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./environments/environment */ 2340);




if (_environments_environment__WEBPACK_IMPORTED_MODULE_1__.environment.production) {
  (0,_angular_core__WEBPACK_IMPORTED_MODULE_2__.enableProdMode)();
}
_angular_platform_browser__WEBPACK_IMPORTED_MODULE_3__.platformBrowser().bootstrapModule(_app_app_module__WEBPACK_IMPORTED_MODULE_0__.AppModule).catch(err => console.log(err));

/***/ })

},
/******/ __webpack_require__ => { // webpackRuntimeModules
/******/ var __webpack_exec__ = (moduleId) => (__webpack_require__(__webpack_require__.s = moduleId))
/******/ __webpack_require__.O(0, ["vendor"], () => (__webpack_exec__(4431)));
/******/ var __webpack_exports__ = __webpack_require__.O();
/******/ }
]);
//# sourceMappingURL=main.js.map