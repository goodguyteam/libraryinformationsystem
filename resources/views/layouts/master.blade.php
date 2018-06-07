@extends('layouts.app')

@section('sidebar')
    <ul id="menu" class="page-sidebar-menu">
        <li class="active" id="active">
            <a href="{{ route('dashboard') }}">
                <i class="livicon" data-name="home" data-size="18" data-c="#418BCA" data-hc="#418BCA" data-loop="true"></i>
                <span class="title">Dashboard</span>
            </a>
        </li>
        <li>
            <a href="#">
                <i class="livicon" data-name="gears" data-size="18" data-c="#EF6F6C" data-hc="#EF6F6C" data-loop="true"></i>
                <span class="title">System Setup</span>
                <span class="fa arrow"></span>
            </a>
            <ul class="sub-menu">
                <li>
                    <a href="{{ route('site-configuration.index') }}">
                        <i class="fa fa-angle-double-right"></i> Settings
                    </a>
                </li>
                <li>
                    <a href="{{ route('identity-management.index') }}">
                        <i class="fa fa-angle-double-right"></i> Identity Management
                    </a>
                </li>

                <li>
                    <a href="{{ route('student-management.index') }}">
                        <i class="fa fa-angle-double-right"></i> Students List
                    </a>
                </li>
                <li>
                    <a href="{{ route('authors.index') }}">
                        <i class="fa fa-angle-double-right"></i> Authors
                    </a>
                </li>
                <li>
                    <a href="{{ route('publishers.index') }}">
                        <i class="fa fa-angle-double-right"></i> Publisher
                    </a>
                </li>
                <li>
                    <a href="{{ route('classifications.index') }}">
                        <i class="fa fa-angle-double-right"></i> Library of Congress &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Classification
                    </a>
                </li>
                <li>
                    <a href="{{ route('library-shelves.index') }}">
                        <i class="fa fa-angle-double-right"></i> Library Shelves
                    </a>
                </li>
                <li>
                    <a href="{{ route('shelf-sections.index') }}">
                        <i class="fa fa-angle-double-right"></i> Shelf Sections
                    </a>
                </li>
                <li>
                    <a href="{{ route('genres.index')  }}">
                        <i class="fa fa-angle-double-right"></i> Genres
                    </a>
                </li>
                <li>
                    <a href="{{ route('subjects.index') }}">
                        <i class="fa fa-angle-double-right"></i> Subjects
                    </a>
                </li>
            </ul>
        </li>
        <li>
            <a href="#">
                <i class="livicon" data-name="retweet" data-size="18" data-c="#F89A14" data-hc="#F89A14" data-loop="true"></i>
                <span class="title">Transaction</span>
                <span class="fa arrow"></span>
            </a>
            <ul class="sub-menu">
                <li>
                    <a href="{{ route('book-infos.index') }}">
                        <i class="fa fa-angle-double-right"></i> Book Info List
                    </a>
                </li>
                <li>
                    <a href="{{ route('acquisition-infos.index') }}">
                        <i class="fa fa-angle-double-right"></i> Book Acquisition List
                    </a>
                </li>
                <li>
                    <a href="{{ route('book-inventories.index') }}">
                        <i class="fa fa-angle-double-right"></i> Book Inventories List
                    </a>
                </li>
                <li>
                    <a href="{{ route('book-circulations.index') }}">
                        <i class="fa fa-angle-double-right"></i> Book Circulation
                    </a>
                </li>
                <li>
                    <a href="{{ route('disposal-infos.index') }}">
                        <i class="fa fa-angle-double-right"></i> Disposal List
                    </a>
                </li>
            </ul>
        </li>
        <li>
            <a href="#">
                <i class="livicon" data-name="search" data-size="18" data-c="#01bc8c" data-hc="#01bc8c" data-loop="true"></i>
                <span class="title">Queries</span>
                <span class="fa arrow"></span>
            </a>
            <ul class="sub-menu">
                <li>
                    <a href="{{ url('#') }}">
                        <i class="fa fa-angle-double-right"></i> Query #1
                    </a>
                </li>
            </ul>
        </li>
        <li>
            <a href="#">
                <i class="livicon" data-name="doc-portrait" data-size="18" data-c="#418BCA" data-hc="#418BCA" data-loop="true"></i>
                <span class="title">Reports</span>
                <span class="fa arrow"></span>
            </a>
            <ul class="sub-menu">
                 <li>
                    <a href="{{ route('report.inventory') }}">
                        <i class="fa fa-angle-double-right"></i> Invetory
                    </a>
                </li>
				                <li>
                    <a href="{{ route('report.genre') }}">
                        <i class="fa fa-angle-double-right"></i> Circulation
                    </a>
                </li>
				                <li>
                    <a href="{{ route('report.condemned') }}">
                        <i class="fa fa-angle-double-right"></i> Condemned
                    </a>
                </li>
				                <li>
                    <a href="{{ route('report.weeding') }}">
                        <i class="fa fa-angle-double-right"></i> Weeding
                    </a>
                </li>
				                <li>
                    <a href="{{ route('report.genre') }}">
                        <i class="fa fa-angle-double-right"></i> Missing
                    </a>
                </li>
            </ul>
        </li>
    </ul>
@endsection
