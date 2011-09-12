<moatag type="AdminLinks" location="admin">
<br/><br/>
<div class="mainblock settings_admin_box">
  <p class="mainblockheader">
    Settings
  </p>
  <div class="mainblockcontent" id="tagblock">
    <div id='tagblockfeedback'><moatag type="SettingsFeedback"></div>
    <form method="post" action="index.php?action=admin_settings" id="settings_form" enctype="multipart/form-data">
      <label for="settings_general" class="settings_section_break" id="settings_general_title">
          General settings.
      </label>
      <fieldset id="settings_general" class="formSettingsFieldset settings_block">
        <input type="hidden" name="moa_form_submitted" value="true"/>
        <ul class="formListSettings">
          <li>
            <label for="setting_SiteName" class="formLabelSettings">
              Your gallery name to be displayed in the header.
            </label>
            <img src="templates/MoaDefault/media/help.png" class="popupImage" title="<moatag type="FormPopupHelp" field="setting_site_name">" alt="popup help" />
            <input type="text" name="setting_SiteName" id="setting_SiteName" value="<moatag type="SettingsValue_SiteName">"/>
          </li>
          
          <li>
            <label for="setting_SiteByline" class="formLabelSettings">
              Your gallery byline to be displayed in the header.
            </label>
            <img src="templates/MoaDefault/media/help.png" class="popupImage" title="<moatag type="FormPopupHelp" field="setting_site_byline">" alt="popup help" />
            <input type="text" name="setting_SiteByline" id="setting_SiteByline" value="<moatag type="SettingsValue_SiteByline">"/>
          </li>
            
          <li>
            <label for="setting_ShowEmptyDescPopups" class="formLabelSettings">
              Display a popup for items with no description?
            </label>
            <img src="templates/MoaDefault/media/help.png" class="popupImage" title="<moatag type="FormPopupHelp" field="setting_show_popups">" alt="popup help" />
            <input type="checkbox" name="setting_ShowEmptyDescPopups" id="setting_ShowEmptyDescPopups" <moatag type="SettingsValue_ShowEmptyDescPopups">/>
          </li>

          <li>
            <label for="setting_EmptyDescPopupText" class="formLabelSettings">
              Blank description popup text.
            </label>
            <img src="templates/MoaDefault/media/help.png" class="popupImage" title="<moatag type="FormPopupHelp" field="setting_empty_desc_popup">" alt="popup help" />
            <input type="text" name="setting_EmptyDescPopupText" id="setting_EmptyDescPopupText" value="<moatag type="SettingsValue_EmptyDescPopupText">"/>
          </li>

          <li>
            <label for="setting_TitleDescLength" class="formLabelSettings">
              Length of shortened description.
            </label>
            <img src="templates/MoaDefault/media/help.png" class="popupImage" title="<moatag type="FormPopupHelp" field="setting_title_desc_length">" alt="popup help" />
            <input type="text" name="setting_TitleDescLength" id="setting_TitleDescLength" value="<moatag type="SettingsValue_TitleDescLength">"/>
          </li>

          <li>
            <label for="setting_StrDelimiter" class="formLabelSettings">
              What character to use to split tags.
            </label>
            <img src="templates/MoaDefault/media/help.png" class="popupImage" title="<moatag type="FormPopupHelp" field="setting_str_delimiter">" alt="popup help" />
            <input type="text" name="setting_StrDelimiter" id="setting_StrDelimiter" value="<moatag type="SettingsValue_StrDelimiter">"/>
          </li>
        </ul>
      </fieldset>
      
      <ul class="settingsErrorList">
        <li id='setting_TitleDescLengthcomment' class='invalidfieldcomment invalidfieldstyle'>'Length of description in title bar' must be a number.</li>
        <li id='setting_StrDelimitercomment' class='invalidfieldcomment invalidfieldstyle'>The tag-splitting character must be set.</li>
      </ul>



      <label for="settings_visual" class="settings_section_break" id="settings_visual_title">
          Visual settings.
      </label>
      <fieldset id="settings_visual" class="formSettingsFieldset settings_block">
        <ul class="formListSettings">
          <li>
            <label for="setting_ThumbWidth" class="formLabelSettings">
              Width of thumbnails in pixels.
            </label>
            <img src="templates/MoaDefault/media/help.png" class="popupImage" title="<moatag type="FormPopupHelp" field="setting_thumb_width">" alt="popup help" />
            <input type="text" name="setting_ThumbWidth" id="setting_ThumbWidth" value="<moatag type="SettingsValue_ThumbWidth">"/>
          </li>

          <li>
            <label for="setting_ConfigDisplayMaxWidth" class="formLabelSettings">
              Width of image preview (on view image page) in pixels.
            </label>
            <img src="templates/MoaDefault/media/help.png" class="popupImage" title="<moatag type="FormPopupHelp" field="setting_preview_width">" alt="popup help" />
            <input type="text" name="setting_ConfigDisplayMaxWidth" id="setting_ConfigDisplayMaxWidth" value="<moatag type="SettingsValue_ConfigDisplayMaxWidth">"/>
          </li>

          <li>
            <label for="setting_DisplayPlainSubgalleries" class="formLabelSettings">
              Hide image thumbnails if a subgallery is present.
            </label>
            <img src="templates/MoaDefault/media/help.png" class="popupImage" title="<moatag type="FormPopupHelp" field="setting_plain_subgalleries">" alt="popup help" />
            <input type="checkbox" name="setting_DisplayPlainSubgalleries" id="setting_DisplayPlainSubgalleries" <moatag type="SettingsValue_DisplayPlainSubgalleries">/>
          </li>
          
          <li>
            <label for="setting_ImagesPerPage" class="formLabelSettings">
              Number of images to show per gallery page.
            </label>
            <img src="templates/MoaDefault/media/help.png" class="popupImage" title="<moatag type="FormPopupHelp" field="setting_images_per_page">" alt="popup help" />
            <input type="text" name="setting_ImagesPerPage" id="setting_ImagesPerPage" value="<moatag type="SettingsValue_ImagesPerPage">"/>
          </li>
        </ul>
      </fieldset>
      
      <ul class="settingsErrorList">
        <li id='setting_ThumbWidthcomment' class='invalidfieldcomment invalidfieldstyle'>The thumbnail width must be a number.</li>
        <li id='setting_ConfigDisplayMaxWidthcomment' class='invalidfieldcomment invalidfieldstyle'>Image preview width must be a number.</li>
        <li id='setting_ImagesPerPagecomment' class='invalidfieldcomment invalidfieldstyle'>Images per page must be a number.</li>
      </ul>  


      <moatag type="SettingsDatabaseForm">
      
      <ul class="formListSettings">
        <li class="formButtonsSettings">
          <input type="submit" id="settings_submit" class="abc def" value="Save"/>
        </li>
      </ul>

    </form>
    
    <ul class="formListSettings">
      <li id="submit_container"></li>
    </ul>
  </div>
</div>