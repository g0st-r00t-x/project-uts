import React, { useEffect, useState } from 'react'
import { Input } from './ui/input';
import ColumnVisibilityTable from './ColumnVisibility';
import { router } from '@inertiajs/react';
import { ColumnVisibility, Filters } from '@/types';

interface searchInputProps {
  data: Filters;
}

const SearchInput = ({data}: searchInputProps) => {
    const [search, setSearch] = useState(data.search || "");
    const [searchTimeout, setSearchTimeout] = useState<NodeJS.Timeout | null>(
        null
    );
    
    const handleSearch = (value: string) => {
        setSearch(value);

        // Debounce search
        if (searchTimeout) {
            clearTimeout(searchTimeout);
        }

        const timeout = setTimeout(() => {
            router.get(
                route("products"),
                {
                    search: value,
                    page: 1, // Reset to page 1 when searching
                    sort: data.sort,
                    direction: data.direction,
                },
                {
                    preserveState: true,
                    replace: true,
                }
            );
        }, 500); // 500ms delay

        setSearchTimeout(timeout);
    };
    
    return (

            <div className="w-2/3 md:w-2/3">
                <Input
                    placeholder="Search products..."
                    value={search}
                    onChange={(e) => handleSearch(e.target.value)}
                    className="w-full"
                />
            </div>

    );
}

export default SearchInput
