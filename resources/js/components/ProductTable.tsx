// ProductTable.tsx

import {
    Table,
    TableBody,
    TableCell,
    TableHead,
    TableHeader,
    TableRow,
} from "@/components/ui/table";
import SortableHeader from "@/components/SortableHeader";
import { ProductTableProps } from "@/types";
import { Link, router } from "@inertiajs/react";
import { Button } from "./ui/button";
import { SquarePen } from "lucide-react";
import { ConfirmDeleteDialog } from "./ConfirmDeleteDialog";
import { toast } from "@/hooks/use-toast";


const ProductTable: React.FC<ProductTableProps> = ({
    products,
    columnVisibility,
    formatPrice,
    handleSort,
    filters,
}) => {

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
        <Table>
            <TableHeader>
                <TableRow>
                    {columnVisibility.name && (
                        <TableHead>
                            <SortableHeader
                                column="name"
                                label="Name"
                                currentSort={filters.sort}
                                currentDirection={filters.direction}
                                onSort={handleSort}
                            />
                        </TableHead>
                    )}
                    {columnVisibility.description && (
                        <TableHead>Description</TableHead>
                    )}
                    {columnVisibility.price && (
                        <TableHead>
                            <SortableHeader
                                column="price"
                                label="Price"
                                currentSort={filters.sort}
                                currentDirection={filters.direction}
                                onSort={handleSort}
                            />
                        </TableHead>
                    )}
                    {columnVisibility.stock && (
                        <TableHead>
                            <SortableHeader
                                column="stock"
                                label="Stock"
                                currentSort={filters.sort}
                                currentDirection={filters.direction}
                                onSort={handleSort}
                            />
                        </TableHead>
                    )}
                    {columnVisibility.category && (
                        <TableHead>
                            <SortableHeader
                                column="category"
                                label="Category"
                                currentSort={filters.sort}
                                currentDirection={filters.direction}
                                onSort={handleSort}
                            />
                        </TableHead>
                    )}
                    <TableHead>Actions</TableHead>
                </TableRow>
            </TableHeader>
            <TableBody>
                {products.map((product) => (
                    <TableRow key={product.id}>
                        {columnVisibility.name && (
                            <TableCell>{product.name}</TableCell>
                        )}
                        {columnVisibility.description && (
                            <TableCell>{product.description}</TableCell>
                        )}
                        {columnVisibility.price && (
                            <TableCell>{formatPrice(product.price)}</TableCell>
                        )}
                        {columnVisibility.stock && (
                            <TableCell>{product.stock}</TableCell>
                        )}
                        {columnVisibility.category && (
                            <TableCell>{product.category}</TableCell>
                        )}
                        <TableCell>
                            <div className="flex space-x-2">
                                <Link href={route("products.edit", product.id)}>
                                    <Button variant="outline" size="sm">
                                        <SquarePen />
                                    </Button>
                                </Link>
                                <ConfirmDeleteDialog
                                    onConfirm={() => handleDelete(product.id)}
                                    title="Delete Product"
                                    description={`Are you sure you want to delete the product "${product.name}"? This action cannot be undone.`}
                                />
                            </div>
                        </TableCell>
                    </TableRow>
                ))}
            </TableBody>
        </Table>
    );
};

export default ProductTable;
