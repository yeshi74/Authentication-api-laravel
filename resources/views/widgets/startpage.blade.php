<div class="content-body">
  @if($opts['typ']  == "FORM")
    <section id="multiple-column-form">
        <div class="row match-height">
  @endif
  @if($opts['typ'] =="TABLE")
    <section id="column-selectors">
        <div class="row">
  @endif
  <div class="col-12">
    <div class="card">
      @if($opts['caption'] != "")
        <div class="card-header">
          <h4 class="card-title">{!! $opts['caption'] !!}</h4>
        </div>
      @endif
      <div class="card-content">
        <div class="card-body">