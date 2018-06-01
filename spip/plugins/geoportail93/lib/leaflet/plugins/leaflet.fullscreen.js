.leaflet-control-fullscreen a {
  background:#fff url(fullscreen.png) no-repeat 0 0;
  background-size:26px 52px;
  }
  .leaflet-fullscreen-on .leaflet-control-fullscreen a {
    background-position:0 -26px;
    }

.leaflet-container:-webkit-full-screen {
  width:100%!important;
  height:100%!important;
  }
.leaflet-pseudo-fullscreen {
  position:fixed!important;
  width:100%!important;
  height:100%!important;
  top:0!important;
  left:0!important;
  z-index:99999;
  }

@media
  (-webkit-min-device-pixel-ratio:2),
  (min-resolution:192dpi) {
    .leaflet-control-fullscreen a {
      background-image:url(fullscreen@2x.png);
    }
  }