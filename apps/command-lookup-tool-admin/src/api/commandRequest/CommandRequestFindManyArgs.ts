import { CommandRequestWhereInput } from "./CommandRequestWhereInput";
import { CommandRequestOrderByInput } from "./CommandRequestOrderByInput";

export type CommandRequestFindManyArgs = {
  where?: CommandRequestWhereInput;
  orderBy?: Array<CommandRequestOrderByInput>;
  skip?: number;
  take?: number;
};
