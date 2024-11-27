import React, { useState, useEffect } from "react";
import { router } from "@inertiajs/react";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { Head, Link, usePage } from "@inertiajs/react";
import { Button } from "@/components/ui/button";
import { Input } from "@/components/ui/input";
import {
    Table,
    TableBody,
    TableCell,
    TableHead,
    TableHeader,
    TableRow,
} from "@/components/ui/table";
import {
    Pagination,
    PaginationContent,
    PaginationItem,
    PaginationLink,
    PaginationNext,
    PaginationPrevious,
} from "@/components/ui/pagination";
import { ConfirmDeleteDialog } from "@/components/ConfirmDeleteDialog";
import { useToast } from "@/hooks/use-toast";


// Define Product type
interface Product {
    id: number;
    name: string;
    description: string;
    price: number;
    stock: number;
    category: string;
}

// Define Filters type
interface Filters {
    search?: string;
    sort?: string;
    direction?: "asc" | "desc";
}

// Define Page Props type
interface PageProps {
    auth: {
        user: any;
    };
    products: {
        data: Product[];
        links: Array<{
            url: string | null;
            label: string;
            active: boolean;
        }>;
    };
    filters: Filters;
}

// Sortable Header Component
const SortableHeader: React.FC<{
    column: string;
    label: string;
    currentSort?: string;
    currentDirection?: "asc" | "desc";
    onSort: (column: string, direction: "asc" | "desc") => void;
}> = ({ column, label, currentSort, currentDirection, onSort }) => {
    const isSorted = currentSort === column;
    const nextDirection = isSorted
        ? currentDirection === "asc"
            ? "desc"
            : "asc"
        : "asc";

    return (
        <Button
            variant="ghost"
            onClick={() => onSort(column, nextDirection)}
            className="flex items-center"
        >
            {label}
            {isSorted && (
                <span className="ml-2">
                    {currentDirection === "asc" ? "▲" : "▼"}
                </span>
            )}
        </Button>
    );
};

export default function Page({ auth, products, filters }: PageProps) {
    const { toast } = useToast();
    const [search, setSearch] = useState(filters.search || "");
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
                    sort: filters.sort,
                    direction: filters.direction,
                },
                {
                    preserveState: true,
                    replace: true,
                }
            );
        }, 500); // 500ms delay

        setSearchTimeout(timeout);
    };

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

    const handleDelete = (id: number) => {
        router.delete(route("products.destroy", id), {
            onSuccess: () => {
                toast({
                    title: "Product Deleted",
                    description: "The product has been successfully deleted.",
                });
                console.log("Success");
            },
            onError: (errors) => {
                toast({
                    title: "Error",
                    description:
                        "Failed to delete the product. Please try again.",
                    variant: "destructive",
                });
                console.error(errors);
            },
        });
    };

    return (
        <AuthenticatedLayout
            user={auth.user}
            header={
                <div className="flex justify-between items-center">
                    <h2 className="font-semibold text-xl text-gray-800 leading-tight">
                        Products
                    </h2>
                    <Link href={route("products.create")}>
                        <Button>Add New Product</Button>
                    </Link>
                </div>
            }
        >
            <Head title="Products" />

            <div className="py-12">
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    {/* Search Input */}
                    <div className="mb-4">
                        <Input
                            placeholder="Search products..."
                            value={search}
                            onChange={(e) => handleSearch(e.target.value)}
                            className="w-full"
                        />
                    </div>

                    <div className="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <Table>
                            <TableHeader>
                                <TableRow>
                                    <TableHead>
                                        <SortableHeader
                                            column="name"
                                            label="Name"
                                            currentSort={filters.sort}
                                            currentDirection={filters.direction}
                                            onSort={handleSort}
                                        />
                                    </TableHead>
                                    <TableHead>Description</TableHead>
                                    <TableHead>
                                        <SortableHeader
                                            column="price"
                                            label="Price"
                                            currentSort={filters.sort}
                                            currentDirection={filters.direction}
                                            onSort={handleSort}
                                        />
                                    </TableHead>
                                    <TableHead>
                                        <SortableHeader
                                            column="stock"
                                            label="Stock"
                                            currentSort={filters.sort}
                                            currentDirection={filters.direction}
                                            onSort={handleSort}
                                        />
                                    </TableHead>
                                    <TableHead>
                                        <SortableHeader
                                            column="category"
                                            label="Category"
                                            currentSort={filters.sort}
                                            currentDirection={filters.direction}
                                            onSort={handleSort}
                                        />
                                    </TableHead>
                                    <TableHead>Actions</TableHead>
                                </TableRow>
                            </TableHeader>
                            <TableBody>
                                {products.data.map((product) => (
                                    <TableRow key={product.id}>
                                        <TableCell>{product.name}</TableCell>
                                        <TableCell>
                                            {product.description}
                                        </TableCell>
                                        <TableCell>
                                            {formatPrice(product.price)}
                                        </TableCell>
                                        <TableCell>{product.stock}</TableCell>
                                        <TableCell>
                                            {product.category}
                                        </TableCell>
                                        <TableCell>
                                            <div className="flex space-x-2">
                                                <Link
                                                    href={route(
                                                        "products.edit",
                                                        product.id
                                                    )}
                                                >
                                                    <Button
                                                        variant="outline"
                                                        size="sm"
                                                    >
                                                        Edit
                                                    </Button>
                                                </Link>
                                                <ConfirmDeleteDialog
                                                    onConfirm={() =>
                                                        handleDelete(product.id)
                                                    }
                                                    title="Delete Product"
                                                    description={`Are you sure you want to delete the product "${product.name}"? This action cannot be undone.`}
                                                />
                                            </div>
                                        </TableCell>
                                    </TableRow>
                                ))}
                            </TableBody>
                        </Table>

                        {/* Pagination */}
                        <div className="p-4">
                            <Pagination>
                                <PaginationContent>
                                    {products.links.map((link, index) => (
                                        <PaginationItem key={index}>
                                            <PaginationLink
                                                href={link.url || ""}
                                                isActive={link.active}
                                            >
                                                {link.label ===
                                                "&laquo; Previous" ? (
                                                    <PaginationPrevious />
                                                ) : link.label ===
                                                  "Next &raquo;" ? (
                                                    <PaginationNext />
                                                ) : (
                                                    link.label
                                                )}
                                            </PaginationLink>
                                        </PaginationItem>
                                    ))}
                                </PaginationContent>
                            </Pagination>
                        </div>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
