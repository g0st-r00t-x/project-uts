import { useState, useEffect } from "react";
import { router } from "@inertiajs/react";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { Head, Link } from "@inertiajs/react";
import { Button } from "@/components/ui/button";
import { ColumnVisibility, ProductPageProps } from "@/types";
import ColumnVisibilityTable from "@/components/ColumnVisibility";
import ProductTable from "@/components/ProductTable";
import SearchInput from "@/components/SearchInput";
import TablePagination from "@/components/TablePagination";

export default function Page({ auth, products, filters }: ProductPageProps) {
    // Initialize column visibility state from local storage
    console.log(products)
    const [columnVisibility, setColumnVisibility] = useState<ColumnVisibility>(
        () => {
            const storedVisibility = localStorage.getItem(
                "productColumnVisibility"
            );
            return storedVisibility
                ? JSON.parse(storedVisibility)
                : {
                      name: true,
                      description: true,
                      price: true,
                      stock: true,
                      category: true,
                  };
        }
    );
    const toggleColumnVisibility = (column: keyof ColumnVisibility) => {
        setColumnVisibility((prev) => ({
            ...prev,
            [column]: !prev[column],
        }));
    };
    // Update local storage when column visibility changes
    useEffect(() => {
        localStorage.setItem(
            "productColumnVisibility",
            JSON.stringify(columnVisibility)
        );
    }, [columnVisibility]);

    const handleSort = (column: string, direction: "asc" | "desc") => {
        router.get(
            route("products"),
            {
                sort: column,
                direction: direction,
                search: filters.search,
                page: 1, // Reset to page 1 when sorting
            },
            {
                preserveState: true,
                replace: true,
            }
        );
    };

    const formatPrice = (price: number) => {
        return new Intl.NumberFormat("id-ID", {
            style: "currency",
            currency: "IDR",
        }).format(price);
    };

    // Toggle column visibility

    return (
        <AuthenticatedLayout
            user={auth.user}
            header={
                <div className="flex justify-between items-center">
                    <h2 className="font-semibold text-xl text-gray-800 leading-tight">
                        Products
                    </h2>
                    <div className="flex items-center space-x-4">
                        <Link href={route("products.create")}>
                            <Button>Add New Product</Button>
                        </Link>
                    </div>
                </div>
            }
        >
            <Head title="Products" />

            <div className="py-12">
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div className="bg-white overflow-hidden shadow-sm sm:rounded-lg p-10">
                        {/* Search Input */}
                        <div className="mb-10 flex justify-between">
                            <SearchInput data={filters} />
                            {/* Column Visibility Dropdown */}
                            <ColumnVisibilityTable
                                columnVisibility={columnVisibility}
                                toggleColumnVisibility={toggleColumnVisibility}
                            />
                        </div>
                        <ProductTable
                            products={products.data}
                            columnVisibility={columnVisibility}
                            formatPrice={formatPrice}
                            handleSort={handleSort}
                            filters={filters}
                        />

                        {/* Pagination */}
                        <div className="p-4">
                            <TablePagination links={products.links} />
                        </div>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
