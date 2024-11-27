import React, { useState } from "react";
import { Head, useForm, Link } from "@inertiajs/react";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { Button } from "@/components/ui/button";
import { Input } from "@/components/ui/input";
import { Label } from "@/components/ui/label";
import { Textarea } from "@/components/ui/textarea";

export default function EditProduct({ auth, product }) {
    const { data, setData, put, processing, errors } = useForm({
        name: product.name,
        description: product.description || "",
        price: product.price,
        stock: product.stock,
        category: product.category || "",
    });

    const handleSubmit = (e) => {
        e.preventDefault();
        put(route("products.update", product.id));
    };

    return (
        <AuthenticatedLayout
            user={auth.user}
            header={
                <div className="flex justify-between items-center">
                    <h2 className="font-semibold text-xl text-gray-800 leading-tight">
                        Edit Product
                    </h2>
                </div>
            }
        >
            <Head title={`Edit Product: ${product.name}`} />

            <div className="py-12">
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div className="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                        <form onSubmit={handleSubmit} className="space-y-4">
                            <div>
                                <Label htmlFor="name">Product Name</Label>
                                <Input
                                    id="name"
                                    type="text"
                                    value={data.name}
                                    onChange={(e) =>
                                        setData("name", e.target.value)
                                    }
                                    className="mt-1 w-full"
                                    placeholder="Enter product name"
                                />
                                {errors.name && (
                                    <div className="text-red-500 mt-1">
                                        {errors.name}
                                    </div>
                                )}
                            </div>

                            <div>
                                <Label htmlFor="description">Description</Label>
                                <Textarea
                                    id="description"
                                    value={data.description}
                                    onChange={(e) =>
                                        setData("description", e.target.value)
                                    }
                                    className="mt-1 w-full"
                                    placeholder="Enter product description"
                                />
                                {errors.description && (
                                    <div className="text-red-500 mt-1">
                                        {errors.description}
                                    </div>
                                )}
                            </div>

                            <div className="grid grid-cols-2 gap-4">
                                <div>
                                    <Label htmlFor="price">Price</Label>
                                    <Input
                                        id="price"
                                        type="number"
                                        value={data.price}
                                        onChange={(e) =>
                                            setData("price", e.target.value)
                                        }
                                        className="mt-1 w-full"
                                        placeholder="Enter price"
                                        min="0"
                                        step="0.01"
                                    />
                                    {errors.price && (
                                        <div className="text-red-500 mt-1">
                                            {errors.price}
                                        </div>
                                    )}
                                </div>

                                <div>
                                    <Label htmlFor="stock">Stock</Label>
                                    <Input
                                        id="stock"
                                        type="number"
                                        value={data.stock}
                                        onChange={(e) =>
                                            setData("stock", e.target.value)
                                        }
                                        className="mt-1 w-full"
                                        placeholder="Enter stock quantity"
                                        min="0"
                                    />
                                    {errors.stock && (
                                        <div className="text-red-500 mt-1">
                                            {errors.stock}
                                        </div>
                                    )}
                                </div>
                            </div>

                            <div>
                                <Label htmlFor="category">Category</Label>
                                <Input
                                    id="category"
                                    type="text"
                                    value={data.category}
                                    onChange={(e) =>
                                        setData("category", e.target.value)
                                    }
                                    className="mt-1 w-full"
                                    placeholder="Enter product category"
                                />
                                {errors.category && (
                                    <div className="text-red-500 mt-1">
                                        {errors.category}
                                    </div>
                                )}
                            </div>

                            <div className="flex items-center justify-end space-x-4 mt-6">
                                <Link href={route("products")}>
                                    <Button type="button" variant="outline">
                                        Cancel
                                    </Button>
                                </Link>
                                <Button type="submit" disabled={processing}>
                                    {processing
                                        ? "Updating..."
                                        : "Update Product"}
                                </Button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
