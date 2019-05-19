@extends('admin.layouts.default')
@section('content')
    <p>This utility provides the ability to reset the custom database tables used by this plugin.</p>
    <table class="wp-list-table widefat striped">
        <thead>
        <tr>
            <th scope="col">Table</th>
            <th scope="col">Status</th>
            <th scope="col">Manage</th>
        </tr>
        </thead>
        <tbody>
            @foreach($tables as $table => $entry)
                <tr>
                    <td class="column-primary">
                        {{ $table }}
                    </td>
                    <td>
                        {{ $entry->status ? $entry->status : 'UnInstalled' }}
                    </td>
                    <td>
                        @if($entry->status)
                            <a href="{{ admin_url("admin.php?page={$panel}&action=refresh&table={$table}") }}"
                               onclick="return confirm('This will erase the table and reinstall the schema and seed data.    Are you sure?')"
                               class="button button-secondary">
                                ReFresh Schema
                            </a>
                            <a href="{{ admin_url("admin.php?page={$panel}&action=drop&table={$table}") }}"
                               onclick="return confirm('This will drop the database table.  Are you sure?')"
                               class="button button-secondary">
                                Drop Schema
                            </a>
                            <a href="{{ admin_url("admin.php?page={$panel}&action=flush&table={$table}") }}"
                               onclick="return confirm('This will flush the database table and delete all the entries.  Are you sure?')"
                               class="button button-secondary">
                                Flush Entries
                            </a>
                        @else
                            <a href="{{ admin_url("admin.php?page={$panel}&action=install&table={$table}") }}"
                               onclick="return confirm('Install the table schema and seed data.  Are you sure?')"
                               class="button button-primary">
                                Install Schema
                            </a>
                        @endif
                    </td>
                </tr>
            @endforeach

        </tbody>
    </table>

@endsection