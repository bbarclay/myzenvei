var hasRightVersion = DetectFlashVer(requiredMajorVersion, requiredMinorVersion, requiredRevision);
var playerTags = definePlayerTags();
if(hasRightVersion) {  // if we've detected an acceptable version
    document.write(playerTags);   // embed the flash movie
  } else {  // flash is too old or we can't detect the plugin
    var alternateContent = altPlayerContent;
    document.write(alternateContent);  // insert non-flash content
  }