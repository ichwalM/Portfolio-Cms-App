@extends('errors.layout')

@section('title', 'Server Error')
@section('code', '5xx')
@section('heading', 'Server Is Having Trouble')
@section('message', 'The server encountered an issue while processing your request. Please retry in a few moments.')
